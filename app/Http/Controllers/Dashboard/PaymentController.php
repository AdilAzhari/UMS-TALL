<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Inertia\Inertia;
use LaravelIdea\Helper\App\Models\_IH_Payment_C;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $historicalPayments = $this->getHistoricalPayments($request);

        $upcomingPayments = $this->getUpcomingPayments($request);

        return Inertia::render('Payments/index', [
            'historicalPayments' => $historicalPayments,
            'upcomingPayments' => $upcomingPayments,
            'initialTab' => $request->query('tab', 'history'),
            'filters' => $request->only('search', 'status', 'tab', 'page'), // Send all filters
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.50',
            'payment_method_id' => 'required|string',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            if ($paymentIntent->status === 'succeeded') {
                return redirect()->back()->with('success', 'Payment successful!');
            } else {
                return redirect()->back()->withErrors(['error' => 'Payment not completed.']);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('payments.create');
    }

    public function paymentHistory()
    {
        $payments = Payment::where('student_id', auth()->user()->student->id)->get();

        return Inertia::render('Payments/History', [
            'payments' => $payments,
        ]);
    }

    /**
     * @return Payment[]|LengthAwarePaginator|AbstractPaginator|\Illuminate\Pagination\LengthAwarePaginator|_IH_Payment_C
     */
    public function getHistoricalPayments(Request $request): AbstractPaginator|_IH_Payment_C|array|\Illuminate\Pagination\LengthAwarePaginator|LengthAwarePaginator
    {
        return Payment::with('course')
            ->where('payment_date', '<=', now())
            ->where('student_id', auth()->user()->student->id)
            ->when($request->search, fn ($query, $search) => $query->search($search))
            ->orderBy('payment_date', 'desc')
            ->paginate(10)
            ->withQueryString(); // Preserve filters in pagination links
    }

    /**
     * @return Payment[]|LengthAwarePaginator|AbstractPaginator|\Illuminate\Pagination\LengthAwarePaginator|_IH_Payment_C
     */
    public function getUpcomingPayments(Request $request): AbstractPaginator|_IH_Payment_C|array|\Illuminate\Pagination\LengthAwarePaginator|LengthAwarePaginator
    {
        return Payment::with('course')
            ->where('status', 'pending')
            ->where('student_id', auth()->user()->student->id)
            ->when($request->search, fn ($query, $search) => $query->search($search))
            ->orderBy('payment_date')
            ->paginate(10)
            ->withQueryString();
    }
}

<?php

namespace App\Http\Controllers;

use App\Interfaces\TicketRepositoryInterface;
use App\Services\Email\TicketMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    private TicketRepositoryInterface $ticketRepository;
    private TicketMailService $ticketMailService;

    public function __construct(TicketRepositoryInterface $ticketRepository,TicketMailService $ticketMailService)
    {
        $this->ticketRepository = $ticketRepository;
        $this->ticketMailService = $ticketMailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->input('search');

        if(!is_null($search)){

            $ticket = $this->ticketRepository->findBy('reference_no',$search);

            if($ticket)
                return view('pages.guest.tickets.index')->with(['ticket'=> $ticket]);
        }

        return redirect()->back()->with('error','Invalid reference number. please try again.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $ticket = $request->only([
                'name',
                'problem',
                'email',
                'phone_number',
            ]);

            $validator = Validator::make($ticket, [
                'name' => 'required',
                'problem' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required|numeric|digits:10',
            ]);

            if ($validator->fails()) {
                Session::flash('error', $validator->messages()->first());
                return redirect()->back()->withInput();
            }

            $ticket = $this->ticketRepository->createTicket($ticket);
            $this->ticketMailService->ticketResponseMail($ticket);

        }catch(\Exception $e){
            \Log::error('TicketController(store) Error - ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
            return redirect()->back()->with('error','Something went wrong. please try again.');
        }

        return redirect()->back()->with('success','The inquiry has been created successfully. You will receive an email shortly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = $this->ticketRepository->find($id);
        $replies = $ticket->replies()->paginate(5);

        return view('pages.guest.tickets.show')->with(['ticket'=> $ticket, 'replies'=> $replies]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TicketRepositoryInterface;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    private TicketRepositoryInterface $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
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
            $tickets = $this->ticketRepository->getBy('name',$search);

            if(!$tickets)
                return redirect()->back()->with('error','No records available.');
        }else{
            $tickets = $this->ticketRepository->findAllPaginated();
        }

        return view('pages.admin.tickets.index')->with(['tickets'=> $tickets]);
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

        return view('pages.admin.tickets.show')->with(['ticket'=> $ticket, 'replies'=> $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

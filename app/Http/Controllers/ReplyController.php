<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\ReplyRepositoryInterface;
use App\Services\Email\TicketMailService;

class ReplyController extends Controller
{
    private ReplyRepositoryInterface $replyRepository;
    private TicketMailService $ticketMailService;

    public function __construct(ReplyRepositoryInterface $replyRepository,TicketMailService $ticketMailService)
    {
        $this->replyRepository = $replyRepository;
        $this->ticketMailService = $ticketMailService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reply = $request->only([
            'reply',
            'ticket_id'
        ]);

        $validator = Validator::make($reply, [
            'reply' => 'required',
            'ticket_id' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', $validator->messages()->first());
            return redirect()->back()->withInput();
        }

        $reply = $this->replyRepository->create($reply);
        $this->ticketMailService->ticketReplyMail($reply);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

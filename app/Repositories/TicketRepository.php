<?php

namespace App\Repositories;


use App\Models\Ticket;
use App\Interfaces\TicketRepositoryInterface;
use Illuminate\Support\Str;

class TicketRepository extends BaseEloquentRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    public function createTicket(array $ticket)
    {
        $ticket['reference_no'] = $this->newReferenceNo();//TODO:use a package
        return $this->model->create($ticket);
    }

    private function newReferenceNo()
    {
        $reference = Str::upper(Str::random(12));
        $isUsed =  $this->model->where('reference_no', $reference)->first();
        if ($isUsed) {
            return $this->newReferenceNo();
        }
        return $reference;
    }
}

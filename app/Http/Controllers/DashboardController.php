<?php

namespace App\Http\Controllers;

use App\Services\SMSServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private SMSServiceInterface $smsService;

    public function __construct(SMSServiceInterface $smsService)
    {
        $this->smsService = $smsService;
    }

    public function index()
    {
        $data = $this->smsService->get();
        return view('index',compact('data'));
    }
}

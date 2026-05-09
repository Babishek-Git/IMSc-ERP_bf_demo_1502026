<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractorMail extends Mailable
{
    use Queueable, SerializesModels;
    private $OtpContent;
    public $WorkName;
    public $ConTractorName;
    public $ContractorEmail;
    public $BillValue;
    public $rbn;
    public $mergedArray;
    public $ThisBillRecDataArr;
    public $RecPercArr;
    public $NetPayable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->WorkName = $data['WorkName'];
        $this->ConTractorName = $data['ConTractorName'];
        $this->ContractorEmail = $data['ContractorEmail'];
        $this->BillValue = $data['BillValue'];
        $this->rbn = $data['rbn'];
        $this->mergedArray = $data['mergedArray'];
        $this->ThisBillRecDataArr = $data['ThisBillRecDataArr'];
        $this->RecPercArr = $data['RecPercArr'];
        $this->NetPayable = $data['NetPayable'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ContractorRecoveryMail')
        ->subject('Recovery Notification - BARC')
        ->with([
            'WorkName' => $this->WorkName,
            'ConTractorName' => $this->ConTractorName,
            'ContractorEmail' => $this->ContractorEmail,
            'BillValue' => $this->BillValue,
            'rbn' => $this->rbn,
            'mergedArray' => $this->mergedArray,
            'ThisBillRecDataArr' => $this->ThisBillRecDataArr,
            'RecPercArr' => $this->RecPercArr,
            'NetPayable' => $this->NetPayable,
        ]);
    }
}

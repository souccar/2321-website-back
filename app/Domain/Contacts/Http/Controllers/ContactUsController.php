<?php

namespace App\Domain\Contacts\Http\Controllers;

use App\Domain\Contacts\Http\Requests\ContactUsRequset;
use App\Domain\Contacts\Mail\Mail\ContactMail;
use App\Domain\Contacts\Services\IContactUsService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    private $_contactUsService;
    public function __construct(IContactUsService $contactUsService)
    {
        $this->_contactUsService = $contactUsService;
    }

    public function getAll(Request $request)
    {
        $contacts = $this->_contactUsService->GetAll($request->count != null ? $request->count:5);
        if ($contacts) {
            if ($contacts->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($contacts);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    public function getById($id)
    {
        $contact = $this->_contactUsService->GetById($id);
        if ($contact != null)
            return AhcResponse::sendResponse($contact);
        return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
    }

    public function store(ContactUsRequset $request)
    {
        $request->validated();

        $createdContactUs = $this->_contactUsService->Create($request->all());
        
        // $adminEmail = "tomohamad37souccar@gmail.com";
        //     $data = array(
        //         'name'      =>  'ddddddd',
        //         'message'   =>   'eeeeeeeeeee'
        //     );

        //     Mail::to($adminEmail)->send(new ContactMail($data));

        if (!$createdContactUs) {
            throw AhcResponse::sendResponse([],false,['CreatedError']);
        }

        return AhcResponse::sendResponse($createdContactUs);
    }

    public function destroy($id)
    {
        $isDeleted = $this->_contactUsService->Delete($id);
        
        if ($isDeleted) {
            return response()->json([
                'success'=> true,
                'message'=>'Delete Successfuly'
            ]);
        }else{
            return AhcResponse::sendResponse([],false,['DeleteError']);
        }
    }
}
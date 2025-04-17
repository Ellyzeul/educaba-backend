<?php

namespace App\Http\Controllers;

use App\Actions\Contact\{CreateAction, DeleteAction, ReadAction, UpdateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateContactRequest, DeleteContactRequest, ReadContactRequest, UpdateContactRequest};

class ContactController extends Controller
{
    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, cpf: string, relationship: "father|mother|relative|responsible|other", email: string, phone_primary: string, phone_secondary: string, patient_id: "01jd8y1hf05zjg3jzbktnxrtw4", created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function create(CreateContactRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, cpf: string, relationship: "father|mother|relative|responsible|other", email: string, phone_primary: string, phone_secondary: string, patient_id: "01jd8y1hf05zjg3jzbktnxrtw4", created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}[]
     */
    public function read(ReadContactRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, cpf: string, relationship: "father|mother|relative|responsible|other", email: string, phone_primary: string, phone_secondary: string, patient_id: "01jd8y1hf05zjg3jzbktnxrtw4", created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function update(UpdateContactRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeleteContactRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}

<?php

namespace App\Services;

class ContactService
{
    public function filter($request, $contact)
    {
        $query = $contact;
        if ($request->keyword) {
            $search = $request->keyword;
            $query = $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        if ($request->isRead) {
            $query = $query->andWhere('isRead', $request->isRead);
        }
        $result = $query->orderBy('created_at', 'DESC')->paginate(10);
        $result = $this->appendContactParams($result);
        return $result;
    }

    public function appendContactParams($contactCollection, $param_array = ['keyword', 'isRead'])
    {
        foreach ($param_array as $param) {
            if (isset($_GET[$param])) {
                $contactCollection->appends([$param => $_GET[$param]]);
            }
        }
        return $contactCollection;
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TodoModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Todo extends BaseController
{
    public function index()
    {
        $model = model(TodoModel::class);

        $data['todos'] = $model->findAll();
        return view('admin/todo/index',$data);
    }
    

    public function create()
    {
        helper('form');

        if ($this->request->getMethod() == 'post'){

            if (! $this->validate([
                'title' => 'required|max_length[255]|min_length[3]',
                'description'  => 'required|max_length[5000]|min_length[10]',
            ])) {
                // The validation fails, so returns the form.
                return $this->index();
            }

            // Gets the validated data.
            $post = $this->validator->getValidated();

            $model = model(TodoModel::class);

            $model->save([
                'title'         => $post['title'],
                'description'   => $post['description'],
            ]);

            return view('admin/todo/success');
        }else{
            return view('admin/todo/form');
        }
    }

    public function edit($id)
    {
        helper('form');
        $model = model(TodoModel::class);

        if ($this->request->getMethod() == 'post'){

            if (! $this->validate([
                'title' => 'required|max_length[255]|min_length[3]',
                'description'  => 'required|max_length[5000]|min_length[10]',
            ])) {
                // The validation fails, so returns the form.
                return $this->index();
            }

            // Gets the validated data.
            $post = $this->validator->getValidated();

            $model->save([
                'title'         => $post['title'],
                'description'   => $post['description'],
            ]);

            $data = [
                'title'         => $post['title'],
                'description'   => $post['description'],
            ];

            $model->update($id, $data);

            return view('admin/todo/success');
        }else{
            $data['data'] = $model->find($id);
            return view('admin/todo/form_edit',$data);
        }
    }


    public function delete($id)
    {
        $model = model(TodoModel::class);

        // Fetch the record to be deleted
        $record = $model->find($id);

        if ($record) {
            // Delete the record
            $model->delete($id);
            session()->setFlashdata('success', 'Record deleted successfully');
            // Redirect to a success page or do something else
            return $this->index();
        } else {
            // Handle the case where the record doesn't exist
            session()->setFlashdata('error', "Record doesn't exist");
            // You can redirect to an error page or display a message
            return $this->index();
        }
    }

}

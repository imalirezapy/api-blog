<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'body' => ['required', 'string', 'min:1', 'max:700'],
            'parent_id' => ['exists:comments,id']
        ];
    }
}

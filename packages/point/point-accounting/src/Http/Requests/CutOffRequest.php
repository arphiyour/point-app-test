<?php

namespace Point\PointAccounting\Http\Requests;

use App\Http\Requests\Request;
use Point\Core\Helpers\TempDataHelper;
use Point\Core\Models\Temp;
use Point\PointAccounting\Helpers\CutOffHelper;

class CutOffRequest extends Request
{
    public function response(array $errors)
    {
        return redirect()->back()->withErrors($errors)->withInput(\Input::all());
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'foot_debit'=>'required',
            'foot_credit'=>'required',
            'form_date'=>'required',
            'approval_to'=>'required'
        ];
        
        if (\Input::get('foot_credit') < 1 && \Input::get('foot_debit') < 1) {
            $rules['Failed_foot_credit_less_then_one'] = 'accepted';
            $rules['Failed_foot_debit_less_then_one'] = 'accepted';
        }

        if (number_format_db(\Input::get('foot_credit')) != number_format_db(\Input::get('foot_debit'))) {
            $rules['Failed_foot_credit_and_foot_debit_must_be_balance'] = 'accepted';
        }

        for ($i=0 ; $i<count(\Input::get('debit')) ; $i++) {
            $j = $i+1;

            if (\Input::get('debit')[$i] > 1 && \Input::get('credit')[$i] > 1) {
                $rules['[row_'.$j.']_item_required'] = 'accepted';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'accepted' => ':attribute',
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Liabilities;

use Illuminate\Foundation\Http\FormRequest;

class LiabilityRequest extends FormRequest
{
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
        return [
            'company_id' => 'required|exists:companies,id',
            'sub_company_id' => 'nullable',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'civil_id' => 'required|string|exists:users,civil_id',
            'total_amount' => 'required|integer|in:'.$this->input('sumMilestones'),
            'remaining_amount' => 'required|integer|in:'.$this->input('sumUnPaidMilestones'),
            'is_fully_paid' => 'required|boolean',
            'liability_dates' => 'required|array',
            'liability_dates.*.date' => 'required|date',
            'liability_dates.*.required_amount' => 'required|integer',
            'liability_dates.*.is_paid' => 'required|boolean',
            'sumMilestones' => 'required|integer',
            'notes' => 'nullable|string',
        ];
    }

    public function prepareForValidation()
    {
        $sumMilestones = 0;
        $sumPaidMilestones = 0;
        $sumUnPaidMilestones = 0;

        $mileStonesArr = json_decode($this->input('liability_dates'), associative: true);
        if(!empty($mileStonesArr) &&
            is_array($mileStonesArr)
        ){

            foreach($mileStonesArr as $key => $liability){
                $sumMilestones += $liability['required_amount'];
                if($liability['is_paid']){
                    $sumPaidMilestones += $liability['required_amount'];
                }else{
                    $sumUnPaidMilestones += $liability['required_amount'];
                }
            }
        }

        $this->merge([
            'liability_dates' => $mileStonesArr,
            'sumMilestones' => $sumMilestones,
            'sumPaidMilestones' => $sumPaidMilestones,
            'sumUnPaidMilestones' => $sumUnPaidMilestones
        ]);
    }
}

<?php namespace App\Ninja\Presenters;

use Utils;

/**
 * Class ExpensePresenter
 */
class ExpensePresenter extends EntityPresenter
{

    /**
     * @return string
     */
    public function vendor()
    {
        return $this->entity->vendor ? $this->entity->vendor->getDisplayName() : '';
    }

    /**
     * @return \DateTime|string
     */
    public function expense_date()
    {
        return Utils::fromSqlDate($this->entity->expense_date);
    }

    public function amount()
    {
        return Utils::formatMoney($this->entity->amount, $this->entity->expense_currency_id);
    }

    public function category()
    {
        return $this->entity->expense_category ? $this->entity->expense_category->name : '';
    }

    /**
     * @return string
     */
    public function statusLabel()
    {
        if ($label = parent::statusLabel()) {
            return $label;
        }

        $class = $this->entity->statusClass();
        $label = $this->entity->statusLabel();
        
        return "<span style=\"font-size:13px\" class=\"label label-{$class}\">{$label}</span>";
    }

}

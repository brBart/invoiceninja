<?php namespace App\Ninja\Presenters;

/**
 * Class TaskPresenter
 */
class TaskPresenter extends EntityPresenter
{
    /**
     * @return string
     */
    public function client()
    {
        return $this->entity->client ? $this->entity->client->getDisplayName() : '';
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->entity->user->getDisplayName();
    }

    public function description()
    {
        return substr($this->entity->description, 0, 40) . (strlen($this->entity->description) > 40 ? '...' : '');
    }

    public function project()
    {
        return $this->entity->project ? $this->entity->project->name : '';
    }

    /**
     * @param $account
     * @return mixed
     */
    public function times($account)
    {
        $parts = json_decode($this->entity->time_log) ?: [];
        $times = [];

        foreach ($parts as $part) {
            $start = $part[0];
            if (count($part) == 1 || !$part[1]) {
                $end = time();
            } else {
                $end = $part[1];
            }

            $start = $account->formatDateTime("@{$start}");
            $end = $account->formatTime("@{$end}");

            $times[] = "### {$start} - {$end}";
        }

        return implode("\n", $times);
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

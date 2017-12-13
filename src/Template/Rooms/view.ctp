<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $room
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Room'), ['action' => 'edit', $room->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room'), ['action' => 'delete', $room->id], ['confirm' => __('Are you sure you want to delete # {0}?', $room->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rooms view large-9 medium-8 columns content">
    <h3><?= h($room->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($room->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($room->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Capacity') ?></th>
            <td><?= $this->Number->format($room->capacity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($room->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($room->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('') ?></th>
            <th scope="row"><?= __('Lundi') ?></th>
            <th scope="row"><?= __('Mardi') ?></th>
            <th scope="row"><?= __('Mercredi') ?></th>
            <th scope="row"><?= __('Jeudi') ?></th>
            <th scope="row"><?= __('Vendredi') ?></th>
            <th scope="row"><?= __('Samedi') ?></th>
            <th scope="row"><?= __('Dimanche') ?></th>
        </tr>
        <tr>
            <td></td>
            <td><?= $seance[1] ?></td>
            <td><?= $seance[2] ?></td>
            <td><?= $seance[3] ?></td>
            <td><?= $seance[4] ?></td>
            <td><?= $seance[5] ?></td>
            <td><?= $seance[6] ?></td>
            <td><?= $seance[7] ?></td>
        </tr>

    </table>
</div>

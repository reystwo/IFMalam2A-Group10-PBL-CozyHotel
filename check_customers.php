<?php
$customers = App\Models\Customer::all();
echo "Total: " . $customers->count() . "\n";
foreach ($customers as $c) {
    echo $c->id . " - " . $c->name . " - " . $c->email . " - " . $c->status . "\n";
}

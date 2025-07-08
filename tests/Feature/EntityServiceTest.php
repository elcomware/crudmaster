<?php

namespace Elcomware\CrudMaster\Tests;

use Elcomware\CrudMaster\EntityService;
use Illuminate\Support\Str;


test('get entity', function () {

    //Given


    $m = new EntityService();
    expect($m->GetEntity())->toBe('gotten');
});
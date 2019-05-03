<?php

abstract class Repository{
    protected abstract function getAll($db) ;
    protected abstract function save() ;
}

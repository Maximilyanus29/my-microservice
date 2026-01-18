<?php

interface RequestMiddleware
{
    public function handle(Request $request);
}
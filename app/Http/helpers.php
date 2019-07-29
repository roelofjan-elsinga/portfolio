<?php

function user(): ?\Main\User
{
    return \Main\User::fromRequest(request());
}

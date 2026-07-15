<?php

namespace Usgm;

enum Environments: string
{
    case Production = "https://api.usglobalmail.com";
    case Sandbox = "https://api-sandbox.usglobalmail.com";
}

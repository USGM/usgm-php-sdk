<?php

namespace Usgm\Sandbox\Types;

enum SeedSandboxMailDtoMailType: string
{
    case Letter = "LETTER";
    case Largeletter = "LARGELETTER";
    case Magazine = "MAGAZINE";
    case Catalog = "CATALOG";
    case Softpak = "SOFTPAK";
    case Package = "PACKAGE";
}

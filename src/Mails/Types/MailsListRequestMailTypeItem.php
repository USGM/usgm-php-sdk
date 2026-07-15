<?php

namespace Usgm\Mails\Types;

enum MailsListRequestMailTypeItem: string
{
    case Letter = "letter";
    case LargeLetter = "large_letter";
    case Magazine = "magazine";
    case Package = "package";
    case Softpak = "softpak";
    case Catalog = "catalog";
    case Distribution = "distribution";
    case Fulfillment = "fulfillment";
    case Inventory = "inventory";
}

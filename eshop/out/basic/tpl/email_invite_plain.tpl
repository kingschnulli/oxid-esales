[{ oxmultilang ident="EMAIL_INVITE_HTML_INVITETOSHOP" }] [{ $shop->oxshops__oxname->getRawValue() }]

[{ oxmultilang ident="EMAIL_INVITE_HTML_FROM" }] [{$userinfo->send_name}]
[{ oxmultilang ident="EMAIL_INVITE_HTML_EMAIL" }] [{$userinfo->send_email}]

[{$userinfo->send_message}]

[{ $sHomeUrl }]

[{ oxmultilang ident="EMAIL_INVITE_HTML_MENYGREETINGS" }] [{$userinfo->send_name}]

[{ oxcontent ident="oxemailfooterplain" }]
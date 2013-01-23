<form action="[{ $oViewConf->getSelfActionLink() }]" name="newsletter" method="post">
    <ul class="form inlineForm clear">
        <li>
            [{ $oViewConf->getHiddenSid() }]
            [{ $oViewConf->getNavFormParams() }]
            <input type="hidden" name="fnc" value="subscribe">
            <input type="hidden" name="cl" value="account_newsletter">
            <label for="status">[{ oxmultilang ident="FORM_USER_NEWSLETTER_SUBSCRIPTION" }]</label>
            <select name="status" id="status">
            <option value="1"[{if $oView->isNewsletter() }] selected[{/if }] >[{ oxmultilang ident="FORM_USER_NEWSLETTER_YES" }]</option>
            <option value="0"[{if !$oView->isNewsletter() }] selected[{/if }] >[{ oxmultilang ident="FORM_USER_NEWSLETTER_NO" }]</option>
            </select>
            <button id="newsletterSettingsSave" type="submit" class="submitButton">[{ oxmultilang ident="FORM_USER_NEWSLETTER_SAVE" }]</button>
            [{if $oView->isNewsletter() == 2}]
            <div class="info">
                [{ oxmultilang ident="PAGE_ACCOUNT_REGISTER_SUCCESS_ACTIVATIONEMAIL" }]
            </div>
            [{/if}]
            <span class="notice">[{ oxmultilang ident="FORM_USER_NEWSLETTER_MESSAGE" }]</span>
        </li>
    </ul>
</form>
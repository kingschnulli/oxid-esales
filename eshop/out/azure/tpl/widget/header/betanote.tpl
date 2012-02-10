[{if !$smarty.cookies.hideBetaNote}]
    [{oxscript include="js/libs/cookie/jquery.cookie.js"}]
    [{oxscript include="js/widgets/oxbetanote.js"}]
    <div id="betaNote">
        <div class="notify">
            [{oxmultilang ident='BETA_NOTE'}]
            <span class="dismiss"><a href="#" title="[{oxmultilang ident='BETA_NOTE_CLOSE'}]">x</a></span>
        </div>
    </div>
    [{oxscript add="$('#betaNote').oxBetaNote();"}]
[{/if}]

[{if $oViewConf->isAutoSave() && $oxid != "-1"}]
//writing autosave variable values
    var oMyedit = parent.edit.document.getElementById("myedit");

    if ( oMyedit != null)
    {   var iCtr = 0;
        var blAutosave = false;
        // dynamically collecting variables to store values
        while ( oMyedit.elements.item(iCtr) != null && oMyedit.elements.item(iCtr).name != null)
        {   sName = oMyedit.elements.item(iCtr).name;
            if (sName.search("autosave") != -1)
            {   blAutosave = true;
                iFirstTagPos = sName.indexOf("[")
                iLastTagPos = sName.indexOf("]")
                sAddName = sName.substr((iFirstTagPos+1), (iLastTagPos-iFirstTagPos-1));

                //setting values
                if ( oMyedit.elements.namedItem(sAddName) != null && sAddName != "cl")
                    oMyedit.elements.item(iCtr).value = oMyedit.elements.namedItem(sAddName).value;
                else if ( sAddName == "cl")
                    oMyedit.elements.item(iCtr).value = sLocation;
            }
            iCtr++;
        }

        // setting function to 'save'
        if ( blAutosave) {
            // for saving HMLT editor contents
            if ( parent.edit.submit_form ){
                if ( parent.edit.CopyLongDesc ) {
                    parent.edit.CopyLongDesc();
                }
            }
            oMyedit.fnc.value='save';
            oMyedit.submit();
            return;
        }
    }
[{/if}]
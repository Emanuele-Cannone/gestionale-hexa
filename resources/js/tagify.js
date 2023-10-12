import Tagify from '@yaireo/tagify'
import '@yaireo/tagify/dist/tagify.css';



// initialize Tagify on the above input node reference
if (inputElm.length) {
    inputElm.forEach(function (element) {
        let tagify = new Tagify(element, {
            tagTextProp: 'name', // very important since a custom template is used with this property as text
            enforceWhitelist: true,
            skipInvalid: true, // do not remporarily add invalid tags
            dropdown: {
                closeOnSelect: false,
                enabled: 0,
                classname: 'users-list',
                searchKeys: ['name']  // very important to set by which keys to search for suggestions when typing
            },
            whitelist: tagifyData,
        })

        // qui prende i selezionati
        tagify.addTags(tagifyDataSelected);

    })
} else {
    let tagify = new Tagify(inputElm, {
        tagTextProp: 'name', // very important since a custom template is used with this property as text
        enforceWhitelist: true,
        skipInvalid: true, // do not remporarily add invalid tags
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'users-list',
            searchKeys: ['name']  // very important to set by which keys to search for suggestions when typing
        },
        whitelist: tagifyData,
    })

    // attach events listeners
    tagify.on('dropdown:select', onSelectSuggestion) // allows selecting all the suggested (whitelist) items
        .on('edit:start', onEditStart)  // show custom text in the tag while in edit-mode


    function onSelectSuggestion(e) {
        if (e.detail.event.target.matches('.remove-all-tags')) {
            tagify.removeAllTags()
        }

        // custom class from "dropdownHeaderTemplate"
        else if (e.detail.elm.classList.contains(`${tagify.settings.classNames.dropdownItem}__addAll`))
            tagify.dropdown.selectAll();
    }

    function onEditStart({detail: {tag, data}}) {
        tagify.setTagTextNode(tag, `${data.name}`)
    }
}

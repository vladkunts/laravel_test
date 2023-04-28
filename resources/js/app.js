import './bootstrap';
import Alpine from 'alpinejs';
import autoComplete from "@tarekraafat/autocomplete.js";
import IMask from 'imask';

window.Alpine = Alpine;

Alpine.start();

const autoCompleteJS = new autoComplete({
    //http://localhost/autocompleteSearch?query=iv
    placeHolder: "Search client",
    data: {
        src: async (query) => {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            console.log(token);
            const source = await fetch(`/autocompleteSearch/?query=${query}`, {headers: {"X-CSRF-TOKEN": token}});
            // Data should be an array of `Objects` or `Strings`
            const data = await source.json();
    
            return data;
        },
        keys: ["name"]
    },
    resultItem: {
        highlight: true,
    },
    events: {
        input: {
            selection: (event) => {
                const selection = event.detail.selection.value;
                console.log(event.detail.selection)
                autoCompleteJS.input.value = selection.name;
                console.log(selection)
                document.querySelector("input[name=client_id]").value = selection.id;
            }
        }
    }
});

IMask(
    document.querySelector('input[name=date]'),
    {
      mask: Date,
      lazy: false
    });

IMask(
    document.querySelector('input[name=amount]'),
    {
        mask: /^[\d.]+$/
    });

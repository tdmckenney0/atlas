<?php

return [
    'button' => '<button class="button is-primary"{{attrs}}>{{text}}</button>',
    'label' => '<label{{attrs}} class="label">{{text}}</label>',
    'inputContainer' => '<div class="field">{{content}}</div>',
    'input' => '<input type="{{type}}" name="{{name}}" class="input"{{attrs}} />',
    'select' => '<div class="select"><select name="{{name}}" class="select"{{attrs}}>{{content}}</select></div>',
    'textarea' => '<textarea name="{{name}}" class="textarea"{{attrs}}>{{value}}</textarea>',
    'selectMultiple' => '<div class="select is-multiple"><select name="{{name}}[]" multiple="multiple" {{attrs}}>{{content}}</select></div>',
    'inputSubmit' => '<input type="{{type}}" class="button is-primary"{{attrs}}/>',
    'file' => '<input class="file-input" type="file" name="{{name}}"{{attrs}}>',
];

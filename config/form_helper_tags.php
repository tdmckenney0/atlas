<?php

return [
    'button' => '<button class="btn btn-primary btn-block btn-large"{{attrs}}>{{text}}</button>',
    'inputContainer' => '<div class="form-group">{{content}}</div>',
    'input' => '<input type="{{type}}" name="{{name}}" class="form-control"{{attrs}} />',
    'select' => '<select name="{{name}}" class="form-control"{{attrs}}>{{content}}</select>',
    'textarea' => '<textarea name="{{name}}" class="form-control"{{attrs}}>{{value}}</textarea>',
    'selectMultiple' => '<select name="{{name}}[]" multiple="multiple" class="form-control"{{attrs}}>{{content}}</select>',
    'inputSubmit' => '<input type="{{type}}" class="btn btn-primary btn-block btn-large"{{attrs}}/>',
];

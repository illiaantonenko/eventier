<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute повинен бути прийняті.',
    'active_url' => ':attribute не є дійсним URL.',
    'after' => ':attribute повинно бути датою після :date.',
    'after_or_equal' => ':attribute повинно бути датою після або рівне :date.',
    'alpha' => ':attribute може містити лише букви.',
    'alpha_dash' => ':attribute може містити лише літери, цифри, тире та підкреслення.',
    'alpha_num' => ':attribute може містити лише літери та цифри.',
    'array' => ':attribute повинно бути масивом.',
    'before' => ':attribute повинно бути датою до :date.',
    'before_or_equal' => ':attribute повинно бути датою до або рівне :date.',
    'between' => [
        'numeric' => ':attribute повинно бути між :min та :max.',
        'file' => ':attribute повинно бути між :min та :max кілобайтів.',
        'string' => ':attribute повинно бути між :min та :max символів.',
        'array' => ':attribute повинно бути між :min та :max шт.',
    ],
    'boolean' => ':attribute поле повинно бути true чи false.',
    'confirmed' => ':attribute підтвердження не збігається.',
    'date' => ':attribute не є дійсною датою.',
    'date_equals' => ':attribute повинно бути датою рівною :date.',
    'date_format' => ':attribute формат невідповідає :format.',
    'different' => ':attribute та :other повинні відрізнятися.',
    'digits' => ':attribute повинно бути :digits цифр.',
    'digits_between' => ':attribute повинно бути між :min та :max цифр.',
    'dimensions' => ':attribute має недійсні розміри зображення.',
    'distinct' => ':attribute поле має дублююче значення.',
    'email' => ':attribute має бути дійсною адресою електронної пошти.',
    'exists' => 'обраний :attribute недійсний.',
    'file' => ':attribute має бути файлом.',
    'filled' => ':attribute поле має бути заповненим.',
    "gt" => [
        "numeric" => ":attribute повинен бути більше :value.",
        "file" => ":attribute повинен бути більше :value кілобайт.",
        "string" => ":attribute повинен бути більше :value значення.",
        "array" => ":attribute повинен мати більше :value елементів."
    ],
    "gte" => [
        "numeric" => ":attribute повинен бути більше або дорівнює :value.",
        "file" => ":attribute повинен бути більше або дорівнює :value кілобайт.",
        "string" => ":attribute повинен бути більше або дорівнює :value значення.",
        "array" => ":attribute повинен мати :value шт. або більше."
    ],
    "image" => ":attribute повинен бути зображенням.",
    "in" => "вибране :attribute є недійсним.",
    "in_array" => ":attribute не існує в інших.",
    "integer" => ":attribute повинен бути цілим числом.",
    "ip" => ":attribute повинен бути дійсною IP-адресою.",
    "ipv4" => ":attribute повинен бути дійсною адресою IPv4.",
    "ipv6" => ":attribute повинен бути дійсною адресою IPv6.",
    "json" => ":attribute повинен бути допустимим JSON-рядком.",
    "lt" => [
        "numeric" => ":attribute повинен бути не менше :value.",
        "file" => ":attribute повинен бути не менше :value кілобайт.",
        "string" => ":attribute повинен бути не менше :value символів.",
        "array" => ":attribute повинен мати не менше :value елементів."
    ],
    "lte" => [
        "numeric" => ":attribute повинен бути менше або рівний :value.",
        "file" => ":attribute повинен бути менше або рівний :value кілобайт.",
        "string" => ":attribute повинен бути менше або рівний :value символів.",
        "array" => ":attribute не повинно бути більше :value елементів."
    ],
    "max" => [
        "numeric" => ":attribute не може бути більше ніж :max.",
        "file" => ":attribute не може бути більше ніж :max кілобайт.",
        "string" => ":attribute не може бути більше ніж :max персонажів.",
        "array" => ":attribute не може мати більше ніж :max деталей."
    ],
    "mimes" => ":attribute повинен бути файл типу: :values.",
    "mimetypes" => ":attribute повинен бути файл типу: :values.",
    "min" => [
        "numeric" => ":attribute повинен бути не менше :min.",
        "file" => ":attribute повинен бути як мінімум :min кілобайт.",
        "string" => ":attribute повинен бути як мінімум :min символів.",
        "array" => ":attribute повинен мати як мінімум :min елементів."
    ],
    "not_in" => "обраний :attribute є недійсним.",
    "not_regex" => "формат :attribute є недійсним.",
    "numeric" => ":attribute повинен бути числом.",
    "present" => ":attribute повинні бути присутніми.",
    "regex" => "формат :attribute є недійсним.",
    "required" => "Обов'язкове поле :attribute.",
    "required_if" => ":attribute є обов'язковим, якщо :other рівний :value.",
    "required_unless" => ":attribute є обов'язковою, за винятком випадків :other у :values.",
    "required_with" => ":attribute є обов'язковим, якщо :values присутній.",
    "required_with_all" => ":attribute є обов'язковим, якщо :values присутні.",
    "required_without" => ":attribute є обов'язковим, якщо :values немає.",
    "required_without_all" => ":attribute є обов'язковим, якщо жодна з :values відсутні.",
    "same" => ":attribute і :other повинні збігатися.",
    "size" => [
        "numeric" => ":attribute повинен бути :size.",
        "file" => ":attribute повинен бути :size кілобайт.",
        "string" => ":attribute повинен бути :size символів.",
        "array" => ":attribute повинен містити :size елементів."
    ],
    "starts_with" => ":attribute повинен починатися з одного з наступних :values",
    "string" => ":attribute повинен бути рядком.",
    "timezone" => ":attribute повинен бути дійсною часовою зоною.",
    "unique" => ":attribute вже використовується.",
    "uploaded" => ":attribute не вдалося завантажити.",
    "url" => "формат :attribute є недійсним.",
    "uuid" => ":attribute повинен бути дійсним ідентифікатором UUID.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];

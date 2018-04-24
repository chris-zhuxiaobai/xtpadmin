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

    'accepted'             => '必须接受 :attribute .',
    'active_url'           => ':attribute 不是一个合法的 URL.',
    'after'                => ':attribute 必须在 :date 之后.',
    'alpha'                => ':attribute 仅可以包含字符.',
    'alpha_dash'           => ':attribute 仅可以包含字符、数字和下划线.',
    'alpha_num'            => ':attribute 仅可以包含字符、数字.',
    'array'                => ':attribute 必须是数组.',
    'before'               => ':attribute 必须在 :date 之前.',
    'between'              => [
        'numeric' => ':attribute must be between :min and :max.',
        'file'    => ':attribute must be between :min and :max kilobytes.',
        'string'  => ':attribute must be between :min and :max characters.',
        'array'   => ':attribute must have between :min and :max items.',
    ],
    'boolean'              => ':attribute field must be true or false.',
    'confirmed'            => ':attribute 确认项不匹配.',
    'date'                 => ':attribute 不是合法的日期格式.',
    'date_format'          => ':attribute does not match the format :format.',
    'different'            => ':attribute and :other must be different.',
    'digits'               => ':attribute must be :digits digits.',
    'digits_between'       => ':attribute must be between :min and :max digits.',
    'distinct'             => ':attribute field has a duplicate value.',
    'email'                => ':attribute 必须是一个合法的邮箱地址.',
    'exists'               => '所选项 :attribute 不存在.',
    'filled'               => ':attribute 是必须的.',
    'image'                => ':attribute 必须是一个图片.',
    'in'                   => '所选项 :attribute 不存在.',
    'in_array'             => ':attribute field does not exist in :other.',
    'integer'              => ':attribute 必须是整数.',
    'ip'                   => ':attribute 必须是合法的IP地址.',
    'json'                 => ':attribute 必须是合法的JSON字符串.',
    'max'                  => [
        'numeric' => ':attribute  不能大于 :max.',
        'file'    => ':attribute  不能大于 :max kb.',
        'string'  => ':attribute 不能多于 :max 字符.',
        'array'   => ':attribute  不能多于 :max 项.',
    ],
    'mimes'                => ':attribute 必须是 :values 文件类型.',
    'min'                  => [
        'numeric' => ':attribute 不能小于 :min.',
        'file'    => ':attribute 至少 :min kb.',
        'string'  => ':attribute 至少 :min 字符.',
        'array'   => ':attribute 至少包含 :min 项.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => ':attribute 必须为数字.',
    'present'              => ':attribute 项必须设置.',
    'regex'                => ':attribute 格式不正确.',
    'required'             => ':attribute 必填.',
    'required_if'          => ':attribute 是必须的 当 :other 是 :value.',
    'required_unless'      => ':attribute 是必须的 除非 :other 是 :values.',
    'required_with'        => ':attribute 是必须的 当 :values 已设定.',
    'required_with_all'    => ':attribute 是必须的 当 :values 已设定.',
    'required_without'     => ':attribute 是必须的 当 :values 未设定.',
    'required_without_all' => ':attribute 是必须的 当 :values 无一设定.',
    'same'                 => ':attribute 和 :other 必须匹配.',
    'size'                 => [
        'numeric' => ':attribute 大小必须是 :size.',
        'file'    => ':attribute 必须是:size KB.',
        'string'  => ':attribute 必须是 :size 字符.',
        'array'   => ':attribute 必须包含 :size 项.',
    ],
    'string'               => ':attribute 必须是字符串.',
    'timezone'             => ':attribute 必须是合法的时区.',
    'unique'               => ':attribute 已经存在.',
    'url'                  => ':attribute 格式不正确.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];

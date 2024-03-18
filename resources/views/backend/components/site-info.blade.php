@include('backend.partials.text-input',
                            [
                                "id" => "site_name",
                                "title" => "Site Name"
                            ])

@include('backend.partials.text-input',
            [
                "id" => "site_email",
                "title" => "Site Email"
            ])

@include('backend.partials.text-input',
            [
                "id" => "site_phone",
                "title" => "Site Phone"
            ])

@include("backend.partials.textarea-input",
            [
               "id"     => "site_description",
               "title"  => "Site Description"
            ])

@include("backend.partials.file-input",
            [
               "id"     => "site_logo",
               "title"  => "Site Logo",
               "logo"   => getSiteLogo()
            ])

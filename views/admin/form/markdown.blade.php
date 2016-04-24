<textarea style="display: none" name="{{$name}}">{{$value}}</textarea>
<label for="alias">
    {{$label}}
</label>
<div id="{{$name}}">{{$value}}</div>
<script>
    var markdovn_{{$name}} = $('#{{$name}}').markdownEditor({
        preview:true,
        imageUpload: true,
        fullscreen: false,
        onPreview: function (content, callback) {

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/markdown/preview',
                type: 'POST',
                dataType: 'html',
                data: {
                    content: content
                },
            }).done(function(result) {
              callback(result);
            });
        }
    });
    var editor_{{$name}} = ace.edit(markdovn_{{$name}}.find('.md-editor')[0]);
    editor_{{$name}}.getSession().on('change', function(e) {
        var con = editor_{{$name}}.getSession().getValue();
        $('[name={{$name}}]').val(con);
    });
</script>
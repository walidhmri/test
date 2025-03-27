@extends('layouts.ingenieur')
@section('content')
<!-- Place this tag where you want the Live Helper Chatbox module to render. -->
<div id="lhc_chatbox_embed_container" ></div>

<!-- Place this tag after the Live Helper Chatbox module tag. -->
<script>
    var LHC_API = LHC_API || {};
    LHC_API.args = {
        mode: 'widget',
        lhc_base_url: '//localhost/chat/lhc_web/index.php/',
        wheight: 450,
        wwidth: 350,
        pheight: 520,
        pwidth: 500,
        leaveamessage: true,
        check_messages: true,
        lang: 'fre/',
        user: {
            name: "{{ Auth::user()->name }}",
            email: "{{ Auth::user()->email }}",
            id: "{{ Auth::user()->id }}",
        }
    };

    (function() {
        var po = document.createElement('script'); 
        po.type = 'text/javascript'; 
        po.setAttribute('crossorigin','anonymous'); 
        po.async = true;
        var date = new Date();
        po.src = '//localhost/chat/lhc_web/design/defaulttheme/js/widgetv2/index.js?' + ("" + date.getFullYear() + date.getMonth() + date.getDate());
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(po, s);
    })();
</script>

@endsection
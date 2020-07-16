<!DOCTYPE html>
<html>
    <head>
        <title>View Surat Masuk</title>
    </head>
    <body>
        <p>
            <iframe src="{{url($data->lokasifile.'/'.$data->file)}}" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe>
        </p>
    </body>
</html>
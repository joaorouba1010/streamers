<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Streamers By Shadowy</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <system.webServer><httpProtocol><customHeaders>
                <add name="X-Frame-Options" value="ALLOW" />
    </customHeaders></httpProtocol></system.webServer>

    <script>
        const blocks = [];
        const calling_php = async (fn = "none", ag1 = "none", ag2 = "none", ag3 = "none", ag4 = "none") =>{
            const options = {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams({function: fn, arg1: ag1, arg2: ag2})
            };
            let proc = await fetch('functions.php', options);
            console.log(proc);
            return proc.text();
        }

        const click_on_read = async ()=>{
            let get     = document.getElementById('streamerson');
            let txt     = await calling_php("load_html");
            get.value   = txt;
            console.log(get);
        }

        function click_on_write()
        {
            teste();
            click_on_read();
            let popup = document.getElementById("addnew");
            popup.style.display = "block";
        }

        function hide_me()
        {
            click_on_read();
            let popup = document.getElementById("addnew");
            let txt   = document.getElementById("new_streamer");
            txt.value = "";
            popup.style.display = "none";
        }
        const write_new = async ()=>{
            let get     = document.getElementById('streamerson').value;
            let txt     = document.getElementById("new_streamer").value;
            let new_text = "";
            if(get != ""){
                if(txt != "")
                    new_text = get + ',' + txt;
                else
                    new_text = get;
            }else if(txt != "")
                new_text = txt;
            await calling_php("write_html", new_text);
            hide_me();
        }
    </script>

    <div id="Menu">
        <textarea name="" id="streamerson" readonly cols="45" rows="15"></textarea></br>
        <button onclick="click_on_read()">read streamers</button>
        <button onclick="click_on_write()">Add new streamer</button>
    </div>

    <div id="addnew">
        <div class="close" onclick="hide_me()">X</div>
        <div class="context">
            <span>Coloque o nome do canal do streamer aqui:</span>
            <div class="stream_list">

            </div>
            <input autofocus type="text" name="" id="new_streamer"></br>
            <button onclick="write_new()">OK</button>
            <button onclick="hide_me()">cancel</button>
        </div>
    </div>
</body>
<footer>
    <script>
        click_on_read();
        const teste = () => {
            let flist = document.getElementsByClassName("stream_list")[0];
            let txt = document.getElementById("streamerson").value;

            flist.innerHTML = "";
            if(txt == "")
            return;
            let split_text = txt.split(',');

            split_text.forEach(element => {
                let div = document.createElement('div');
                div.className = "item-inlist";
                let span_txt = document.createElement('span');
                span_txt.innerHTML = element;
                div.appendChild(span_txt);
                let new_btn = document.createElement('div');
                new_btn.className = "close";
                new_btn.innerHTML += "x";
                new_btn.onclick = () => {remove_one_list(span_txt, div)};
                div.appendChild(new_btn);
                flist.appendChild( div );
            });
        }
        const remove_one_list = (me, div) => {
            let x = document.getElementById("streamerson").value.split(',');
            for(let i = 0; i < x.length; ++i){
                if(x[i]==me.innerHTML)
                    x.splice(i, 1);
            }
            document.getElementById("streamerson").value = x;
            div.innerHTML = "";
        }

    </script>
</footer>
</html>
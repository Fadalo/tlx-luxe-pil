<link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
<script src="https://unpkg.com/grapesjs"></script>
<style>
/* Let's highlight canvas boundaries */
#gjs {
    border: 3px solid #444;
    
}

/* Reset some default styling */
.gjs-cv-canvas {
    top: 0;
    width: 100%;
    height: 100%;
    min-height:400px;
    
}

.gjs-block {
    width: auto;
    height: auto;
    min-height: auto;
    
}
</style>
<script src="https://unpkg.com/grapesjs@0.20.3"></script>
<div class="row">
    <div class="col-md-12">
        
    </div>
</div>
<div class="row" >
  
    <div class="col-md-3" style="background-color:white">
       
    </div>
    <div class="col-md-9">
        <div id="gjs">
        <div id="blocks"></div>

        </div>
    </div>




</div>
<br>
<br>
<script>
const editor = grapesjs.init({
    container: '#gjs',
    height: '100%',
    width: 'auto',
    fromElement: false,
    storageManager: {
        type: 'local',
        autosave: true,
        autoload: true,
    },
    blockManager: {
        appendTo: '#blocks',
    },

});

// Manually add basic blocks
const blockManager = editor.BlockManager;

blockManager.add('text', {
    label: 'Text Block',
    content: '<div style="padding:20px; font-size:20px;">Insert your text here</div>',
    category: 'Basic',
});

blockManager.add('image', {
    label: 'Image Block',
    content: '<img src="https://via.placeholder.com/150" alt="Placeholder Image"/>',
    category: 'Basic',
});

blockManager.add('button', {
    label: 'Button',
    content: '<button class="btn">Click Me</button>',
    category: 'Basic',
});

// Custom save command
editor.Commands.add('save-html', {
    run: function(editor, sender) {
        sender && sender.set('active', 0);
        const html = editor.getHtml();
        const css = editor.getCss();
        alert('HTML and CSS saved!\nHTML:\n' + html + '\n\nCSS:\n' + css);
    }
});

// Clear command
editor.Commands.add('cmd-clear', {
    run: function(editor, sender) {
        if (confirm('Are you sure to clean the canvas?')) {
            editor.DomComponents.clear();
        }
    }
});
</script>
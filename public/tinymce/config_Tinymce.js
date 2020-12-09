tinymce.init({
  selector: ".textarea-400", theme: "modern", height: 800,
  relative_urls: false,
    plugins: [
         "visualblocks advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
  //  toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | responsivefilemanager | link unlink anchor | forecolor backcolor  | code",
  //  toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code",
  image_advtab: false,
  toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | table responsivefilemanager | link unlink | forecolor backcolor  | code",
  style_formats: [
    {
      title: 'Headers', items: [
        { title: 'h1', block: 'h1' },
        { title: 'h2', block: 'h2' },
        { title: 'h3', block: 'h3' },
        { title: 'h4', block: 'h4' },
        { title: 'h5', block: 'h5' },
        { title: 'h6', block: 'h6' }
      ]
    },

    {
      title: 'Blocks', items: [
        { title: 'p', block: 'p' },
        { title: 'div', block: 'div' },
        { title: 'pre', block: 'pre' }
      ]
    },

    {
      title: 'Containers', items: [
        { title: 'section', block: 'section', wrapper: true, merge_siblings: false },
        { title: 'article', block: 'article', wrapper: true, merge_siblings: false },
        { title: 'blockquote', block: 'blockquote', wrapper: true },
        { title: 'hgroup', block: 'hgroup', wrapper: true },
        { title: 'aside', block: 'aside', wrapper: true },
        { title: 'figure', block: 'figure', wrapper: true }
      ]
    }
  ],
  visualblocks_default_state: true,
  end_container_on_empty_block: true,
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',

  external_filemanager_path: "public/tinymce/filemanager/",
  filemanager_title: "Responsive Filemanager",
  external_plugins: { "filemanager": "filemanager/plugin.min.js" },
  entity_encoding: "raw",
});

tinymce.init({
  selector: ".textarea-1000", theme: "modern", height: 1000,
  relative_urls: false,
  plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
  ],
  toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code",
  //  toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
  image_advtab: true,

  external_filemanager_path: "public/tinymce/filemanager/",
  filemanager_title: "Responsive Filemanager",
  external_plugins: { "filemanager": "filemanager/plugin.min.js" },
  entity_encoding: "raw",
});

tinymce.init({
  selector: ".textarea-100", theme: "modern", height: 100,
  relative_urls: false,
  plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
  ],
  toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
  entity_encoding: "raw",
});
$(function () {
  let toggle = $('#font-size-toggle'),
    trigger = toggle.find('.font-size-toggle__label'),
    incBtn = toggle.find('.font-size-toggle__increase'),
    decBtn = toggle.find('.font-size-toggle__decrease'),
    indicator = toggle.find('.font-size-toggle__value'),
    initialSizes = {},
    fontSizeSetting = parseFloat(localStorage.getItem('codepenFontSizeSetting'));

 /*css elements to change*/
  let selectorsToScale = [
    'p',
    'button',
    'h1',
    'h2',
    'h3',
    'nav ul li a',
    'html',
    'body'
  ];

  /*get initial font sizes*/
  for (const selector of selectorsToScale) {
    let fontSize = $(selector).css('font-size');

    if (fontSize) {
      fontSize = fontSize.slice(0, fontSize.length - 2);
    } else {
      fontSize = '';
    }

    initialSizes[selector] = fontSize;
  }

  /*saves changes to webpage*/
  if (fontSizeSetting) {
    setFontSizes(fontSizeSetting);
  } else {
    fontSizeSetting = 100.0;
  }

  /*toggle visibility*/
  trigger.click(function () {
    toggle.toggleClass('expanded');
  });

  /*increase font sizes*/
  incBtn.click(function () {
    changeFontSizes('up');
  });

  /*decrease font sizes*/
  decBtn.click(function () {
    changeFontSizes('down');
  });

  /*increase/decrease buttons*/
  function changeFontSizes(direction) {
    if (direction === 'down') {
      fontSizeSetting -= 10;
    } else {
      fontSizeSetting += 10;
    }
    localStorage.setItem('codepenFontSizeSetting', fontSizeSetting);
    setFontSizes(fontSizeSetting);
  }

  /*set font sizes*/
  function setFontSizes(setting) {
    const resizeFactor = setting / 100.0;

    indicator.html(parseInt(setting));

    for (const selector of selectorsToScale) {
      let initialSize = initialSizes[selector];

      initialSize = parseFloat(initialSize);

      let newSize = initialSize * resizeFactor;

      $(selector).css('font-size', newSize + 'px');
    }
  }
})

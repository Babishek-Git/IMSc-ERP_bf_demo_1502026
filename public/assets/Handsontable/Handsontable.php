<!-- <script src="https://cdn.jsdelivr.net/npm/handsontable@13.0/dist/handsontable.full.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@13.0/dist/handsontable.full.min.css" /> 
<script src="https://handsontable.com/docs/scripts/fixer.js"></script> -->
<script src="handsontable.full.js"></script>
<link type="text/css" rel="stylesheet" href="handsontable.full.min.css"/>

<div id="example1"></div>

<div class="controls">
  <button id="load" class="button button--primary button--blue">Load data</button> 
  <button id="save" class="button button--primary button--blue">Save data</button>
  <label>
    <input type="checkbox" name="autosave" id="autosave"/>
    Autosave
  </label>
</div>

<output class="console" id="output">Click "Load" to load data from server</output>
<script>
const container = document.querySelector('#example1');
const exampleConsole = document.querySelector('#output');
const autosave = document.querySelector('#autosave');
const load = document.querySelector('#load');
const save = document.querySelector('#save');

const hot = new Handsontable(container, {
  startRows: 8,
  startCols: 6,
  rowHeaders: true,
  colHeaders: true,
  contextMenu: true,
  height: 'auto',
  afterChange: function (change, source) {
    if (source === 'loadData') {
      return; //don't save this change
    }

    if (!autosave.checked) {
      return;
    }

    fetch('https://handsontable.com/docs/scripts/json/save.json', {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ data: change })
    })
      .then(response => {
        exampleConsole.innerText = `Autosaved (${change.length} cell${change.length > 1 ? 's' : ''})`;
        console.log('The POST request is only used here for the demo purposes');
      });
  }
});

load.addEventListener('click', () => {
  fetch('https://handsontable.com/docs/scripts/json/load.json')
    .then(response => {
      response.json().then(data => {
        hot.loadData(data.data);
        // or, use `updateData()` to replace `data` without resetting states
        exampleConsole.innerText = 'Data loaded';
      });
    });
});
save.addEventListener('click', () => {
  // save all cell's data
  fetch('https://handsontable.com/docs/scripts/json/save.json', {
    method: 'POST',
    mode: 'no-cors',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ data: hot.getData() })
  })
    .then(response => {
      exampleConsole.innerText = 'Data saved';
      console.log('The POST request is only used here for the demo purposes');
    });
});

autosave.addEventListener('click', () => {
  if (autosave.checked) {
    exampleConsole.innerText = 'Changes will be autosaved';
  } else {
    exampleConsole.innerText ='Changes will not be autosaved';
  }
});

</script>

      
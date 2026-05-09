// Date Format dd/mm/yyyy
function FormatDateSlashDDMMYYYY(date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return day + "/" + month + "/" + year;
}
function FormatDateHifDDMMYYYY(date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return day + "." + month + "." + year;
}
function ShowPersonalNotesModal() {
  var MsgStr = '</br></br><div class="formbox disable" style=""><div class="row"><div class="div2 label" align="left"> Personal note &emsp;: </br><font style="font-size: 10px;">(if any..)</font></div>';
  MsgStr += '<div class="div10 lboxlabel wrkname" align="left"><textarea name="txt_est_pers_note" id="txt_est_pers_note" class="tboxsmclass"></textarea></div></div><div class="smclearrow"></div></div>';
  return MsgStr;
}
function parseDDMMYYYY(dateStr) {
  const [day, month, year] = dateStr.split('/').map(Number);
  return new Date(year, month - 1, day); // month is 0-based
}
function getInclusiveDays(fromDate, toDate) {
  const start = parseDDMMYYYY(fromDate);
  const end = parseDDMMYYYY(toDate);

  // Normalize time to avoid DST issues
  start.setHours(0, 0, 0, 0);
  end.setHours(0, 0, 0, 0);

  const diffTime = end - start;
  const diffDays = diffTime / (1000 * 60 * 60 * 24);

  return diffDays + 1; // inclusive
}
const GlobalFormatDateDDMMYYYY = (dateString) => {
  if (!dateString) return "";

  const date = new Date(dateString);
  if (isNaN(date)) return "";

  return new Intl.DateTimeFormat('en-GB', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric'
  }).format(date);
};
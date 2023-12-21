function getDayName(datex, locale) {
    if (datex instanceof Date) {
        return datex.toLocaleDateString(locale, {
            weekday: 'long'
        });
    } else if (datex.isValid && datex.isValid()) { // Check if it's a valid Moment object
        return datex.format('dddd');
    }
    return ""; // Return an empty string for invalid inputs
}

function startDate() {

    // Start Date - DSP Start (turnover to plant)
    var startInput = document.getElementById("start");
    if (!isValidDate(startInput.value)) {
        // Handle invalid date case, e.g., display an error message
        return;
    }

    var start = new Date(startInput.value);
    console.log("Start:", start);
    var day = getDayName(start, "en-EN");
    document.getElementById("startDay").value = day;

    //KO Meeting
    var ltKO = document.getElementById("ltKO").value;
    var momentStart = moment(start);
    momentStart.add(ltKO, 'days');
    var dateKO = momentStart.toDate();
    dateKO = adjustForWeekends(dateKO);
    document.getElementById("dateKO").value = formatDate(dateKO);
    var dayKO = getDayName(dateKO, "en-EN");
    document.getElementById("dayKO").value = dayKO;

    //Fitting Submission
    var ltFS = document.getElementById("ltFS").value;
    var momentFS = moment(dateKO);
    momentFS.add(ltFS, 'days');
    var dateFS = momentFS.toDate();
    dateFS = adjustForWeekends(dateFS);
    document.getElementById("dateFS").value = formatDate(dateFS);
    var dayFS = getDayName(dateFS, "en-EN");
    document.getElementById("dayFS").value = dayFS;

    // DSP Finish (Control Drawing & Artwork Complete)
    var ltDSP = document.getElementById("ltDSP").value;
    var momentDSPF = moment(dateFS);
    momentDSPF.add(ltDSP, 'days');
    var dateDSF = momentDSPF.toDate();
    dateDSF = adjustForWeekends(dateDSF);
    document.getElementById("dateDSF").value = formatDate(dateDSF);
    var dayDSP = getDayName(dateDSF, "en-EN");
    document.getElementById("dayDSP").value = dayDSP;

    //BOM Input 
    var ltBOM = document.getElementById("ltBOM").value;
    var momentBOM = moment(dateDSF);
    momentBOM.add(ltBOM, 'days');
    var dateBOM = momentBOM.toDate();
    dateBOM = adjustForWeekends(dateBOM);
    document.getElementById("dateBOM").value = formatDate(dateBOM);
    var dayBOM = getDayName(dateBOM, "en-EN");
    document.getElementById("dayBOM").value = dayBOM;

    //1st Cost Internal
    var lt1st = document.getElementById("lt1st").value;
    var moment1stCostI = moment(dateBOM);
    moment1stCostI.add(lt1st, 'days');
    var date1st = moment1stCostI.toDate();
    date1st = adjustForWeekends(date1st);
    document.getElementById("date1st").value = formatDate(date1st);
    var day1st = getDayName(date1st, "en-EN");
    document.getElementById("day1st").value = day1st;

    //1st Cost ES
    var lt1stCost = document.getElementById("lt1stCost").value;
    var moment1stCostES = moment(date1st);
    moment1stCostES.add(lt1stCost, 'days');
    var date1stCost = moment1stCostES.toDate();
    date1stCost = adjustForWeekends(date1stCost);
    document.getElementById("date1stCost").value = formatDate(date1stCost);
    var day1stCost = getDayName(date1stCost, "en-EN");
    document.getElementById("day1stCost").value = day1stCost;

    //CR Cost Done
    var ltCR = document.getElementById("ltCR").value;
    var momentCRCostDone = moment(date1stCost);
    momentCRCostDone.add(ltCR, 'days');
    var dateCR = momentCRCostDone.toDate();
    dateCR = adjustForWeekends(dateCR);
    document.getElementById("dateCR").value = formatDate(dateCR);
    var dayCR = getDayName(dateCR, "en-EN");
    document.getElementById("dayCR").value = dayCR;

    //CR Model Ready
    var ltCRModel = document.getElementById("ltCRModel").value;
    var momentCRMR = moment(dateCR);
    momentCRMR.add(ltCRModel, 'days');
    var dateCRModel = momentCRMR.toDate();
    dateCRModel = adjustForWeekends(dateCRModel);
    document.getElementById("dateCRModel").value = formatDate(dateCRModel);
    var dayCRModel = getDayName(dateCRModel, "en-EN");
    document.getElementById("dayCRModel").value = dayCRModel;

    //CR Packout Photo Shot
    var ltCRPac = document.getElementById("ltCRPac").value;
    var momentPac = moment(dateCRModel);
    momentPac.add(ltCRPac, 'days');
    var dateCRPac = momentPac.toDate();
    dateCRPac = adjustForWeekends(dateCRPac);
    document.getElementById("dateCRPac").value = formatDate(dateCRPac);
    var dayCRPac = getDayName(dateCRPac, "en-EN");
    document.getElementById("dayCRPac").value = dayCRPac;

    //CR Model Walkthrough
    var ltCRModelW = document.getElementById("ltCRModelW").value;
    var momentCRMW = moment(dateCRPac);
    momentCRMW.add(ltCRModelW, 'days');
    var dateCRModelW = momentCRMW.toDate();
    dateCRModelW = adjustForWeekends(dateCRModelW);
    document.getElementById("dateCRModelW").value = formatDate(dateCRModelW);
    var dayCRModelW = getDayName(dateCRModelW, "en-EN");
    document.getElementById("dayCRModelW").value = dayCRModelW;

    //CR Model Send
    var ltCRModelSend = document.getElementById("ltCRModelSend").value;
    var momentCRModelS = moment(dateCRModelW);
    momentCRModelS.add(ltCRModelSend, 'days');
    var nextWednesdayCRModelSend = getNextWednesday(momentCRModelS.toDate());
    document.getElementById("dateCRModelSend").value = formatISOString(nextWednesdayCRModelSend);
    var dayCRModelSend = getDayName(nextWednesdayCRModelSend, "en-EN");
    document.getElementById("dayCRModelSend").value = dayCRModelSend;

    //CR Meeting
    var ltCRMeeting = document.getElementById("ltCRMeeting").value;
    var momentCRM = moment(nextWednesdayCRModelSend);
    momentCRM.add(ltCRMeeting, 'days');
    var nextThursdayCRMeeting = getNextThursday(momentCRM.toDate());
    document.getElementById("dateCRMeeting").value = formatISOString(nextThursdayCRMeeting);
    var dayCRMeeting = getDayName(nextThursdayCRMeeting, "en-EN");
    document.getElementById("dayCRMeeting").value = dayCRMeeting;

    var licen = document.getElementById("Licensed").checked;
    console.log(licen);

    if (!licen) {
        // FPR Cost Done when Licensed is not checked
        var ltFPRCostDones = document.getElementById("ltFPR").value;
        var momentFPRCostDones = moment(nextThursdayCRMeeting);
        momentFPRCostDones.add(ltFPRCostDones, 'days');
        var fprCostDoneDate = adjustForWeekend(momentFPRCostDones);
        document.getElementById("dateFPR").value = formatDate(fprCostDoneDate.toDate());
        const dayFPRs = getDayName(fprCostDoneDate, "en-EN");
        document.getElementById("dayFPR").value = dayFPRs;

        var licensorApprovalRow = document.getElementById("licensorApprovalRow");
        licensorApprovalRow.style.display = "none";
    }

    //Licensor Approval
    var ltLA = document.getElementById("ltLA").value;
    var momentCRMeeting = moment(nextThursdayCRMeeting);
    momentCRMeeting.add(ltLA, 'days');
    document.getElementById("dateLA").value = momentCRMeeting.format("yyyy-MM-DD");
    var dateLA = new Date(document.getElementById("dateLA").value);
    var momentLA = moment(dateLA);
    var dayLA = getDayName(dateLA, "en-EN"); // Gives back 'Vrijdag' which is Dutch for Friday.
    if (dayLA == "Saturday") {
        momentLA.add(3, 'days');
    } else if (dayLA == "Sunday") {
        momentLA.add(2, 'days');
    }
    dayLA = getDayName(new Date(momentLA.format("yyyy-MM-DD")), "en-EN");
    document.getElementById("dateLA").value = momentLA.format("yyyy-MM-DD");
    document.getElementById("dayLA").value = dayLA;

    if (licen) {
        // FPR Cost Done when Licensed is checked
        console.log(ltLA);
        var ltFPRCostDone = document.getElementById("ltFPR").value;
        var momentFPRCostDone = moment(momentLA);
        momentFPRCostDone.add(ltFPRCostDone, 'days');
        var fprCostDoneDate = adjustForWeekend(momentFPRCostDone);
        document.getElementById("dateFPR").value = formatDate(fprCostDoneDate.toDate());
        const dayFPR = getDayName(fprCostDoneDate, "en-EN");
        document.getElementById("dayFPR").value = dayFPR;

        var licensorApprovalRow = document.getElementById("licensorApprovalRow");
        licensorApprovalRow.style.display = "flex";
    }

    // FPR Model Ready
    var ltFPRModelReady = document.getElementById("ltFPRModelReady").value;
    var momentFPRModelReady = moment(fprCostDoneDate);
    momentFPRModelReady.add(ltFPRModelReady, 'days');
    var fprModelReadyDate = adjustForWeekend(momentFPRModelReady);
    document.getElementById("dateFPRModelReady").value = formatDate(fprModelReadyDate.toDate());
    var dayFPRModelReady = getDayName(fprModelReadyDate, "en-EN");
    document.getElementById("dayFPRModelReady").value = dayFPRModelReady;

    // FPR PackOut Photo Shot
    var ltFPRPackoutPhoto = document.getElementById("ltFPRPack").value;
    var momentFPRPackoutPhoto = moment(fprModelReadyDate);
    momentFPRPackoutPhoto.add(ltFPRPackoutPhoto, 'days');
    var fprPackoutPhotoDate = adjustForWeekend(momentFPRPackoutPhoto);
    document.getElementById("dateFPRPack").value = formatDate(fprPackoutPhotoDate.toDate());
    var dayFPRPack = getDayName(fprPackoutPhotoDate, "en-EN");
    document.getElementById("dayFPRPack").value = dayFPRPack;

    // FPR Model Walkthrough
    var ltFPRModels = document.getElementById("ltFPRModel").value;
    var momentFPRModelWT = moment(fprPackoutPhotoDate);
    momentFPRModelWT.add(ltFPRModels, 'days');
    var fprModelWT = adjustForWeekend(momentFPRModelWT);
    document.getElementById("dateFPRModel").value = formatDate(fprModelWT.toDate());
    var dayFPRModel = getDayName(fprModelWT, "en-EN");
    document.getElementById("dayFPRModel").value = dayFPRModel;

    //FPR Model Send
    var ltFPRModelSend = document.getElementById("ltFPRModelSend").value;
    var momentFPRModel = moment(fprModelWT);
    momentFPRModel.add(ltFPRModelSend, 'days');
    var nextWednesdayFPRModelSend = getNextWednesday(momentFPRModel.toDate());
    document.getElementById("dateFPRModelSend").value = formatISOString(nextWednesdayFPRModelSend);
    var dayFPRModelSend = getDayName(nextWednesdayFPRModelSend, "en-EN");
    document.getElementById("dayFPRModelSend").value = dayFPRModelSend;

    // Check if CR/FPR is combined or not: If Brand is Normal
    var crfpr = document.getElementById("CRFPR").checked;
    console.log(crfpr);

    if (crfpr) {
        // If CRFPR is checked, set FPR Meeting date to match CR Meeting date
        var ltCRMeeting = document.getElementById("ltCRMeeting").value;
        var momentCRMeet = moment(nextWednesdayCRModelSend);
        momentCRMeet.add(ltCRMeeting, 'days');
        var nextThursdayCRMeeting = getNextThursday(momentCRMeet.toDate());
        document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayCRMeeting);
        var dayFPRMeeting = getDayName(nextThursdayCRMeeting, "en-EN");
        document.getElementById("dayFPRMeeting").value = dayFPRMeeting;

        document.getElementById("dateFPR").value = document.getElementById("dateCR").value;
        document.getElementById("dateFPRModelReady").value = document.getElementById("dateCRModel").value;
        document.getElementById("dateFPRPack").value = document.getElementById("dateCRPac").value;
        document.getElementById("dateFPRModel").value = document.getElementById("dateCRModelW").value;
        document.getElementById("dateFPRModelSend").value = document.getElementById("dateCRModelSend").value;

        document.getElementById("note").textContent = "FPR Dates are the same as CR Dates";
    } else {
        // If CRFPR is not checked, FPR Meeting will be 7D after FPR Model Send
        var ltFPRMeeting = document.getElementById("ltFPRMeeting").value;
        var momentFPRMeet = moment(nextWednesdayFPRModelSend);
        momentFPRMeet.add(ltFPRMeeting, 'days');
        var nextThursdayFPRMeeting = getNextThursday(momentFPRMeet.toDate());
        document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayFPRMeeting);
        var dayFPRMeeting = getDayName(nextThursdayFPRMeeting, "en-EN");
        document.getElementById("dayFPRMeeting").value = dayFPRMeeting;

        document.getElementById("note").textContent = "";
    }
    // End of CR/FPR Conditional Statement

    // -- Start Check Tooling Budget is null or not: For Brand other than Signature and Disney
    var toolingBudgetInput = document.getElementById("ToolBdg").value;
    console.log(toolingBudgetInput);

    var toolingActivitySection = document.getElementById("collapseTooling");

    if (toolingBudgetInput == 0) {
        toolingActivitySection.style.display = 'none';
    } else if (toolingBudgetInput != 0) {
        toolingActivitySection.style.display = 'flex';

        //CDI
        var ltCDI = document.getElementById("ltCDI").value;
        var momentCDI = moment(dateDSF);
        momentCDI.add(ltCDI, 'days');
        var DtCDI = momentCDI.toDate();
        DtCDI = adjustForWeekends(DtCDI);
        document.getElementById("DtCDI").value = formatDate(DtCDI);
        var dayCDI = getDayName(DtCDI, "en-EN");
        document.getElementById("dayCDI").value = dayCDI;
        console.log(ltCDI);

        //1st Digital Review
        var ltDR = document.getElementById("lt1stDR").value;
        var momentDR = moment(dateDSF);
        momentDR.add(ltDR, 'days');
        var Dt1stDR = momentDR.toDate();
        Dt1stDR = adjustForWeekends(Dt1stDR);
        document.getElementById("Dt1stDR").value = formatDate(Dt1stDR);
        var day1stDR = getDayName(Dt1stDR, "en-EN");
        document.getElementById("day1stDR").value = day1stDR;

        //Approved Digital
        var ltAD = document.getElementById("ltAppDig").value;
        var momentAD = moment(Dt1stDR);
        momentAD.add(ltAD, 'days');
        var DAppDig = momentAD.toDate();
        DAppDig = adjustForWeekends(DAppDig);
        document.getElementById("DAppDig").value = formatDate(DAppDig);
        var dayAppDig = getDayName(DAppDig, "en-EN");
        document.getElementById("dayAppDig").value = dayAppDig;

        //Output Model
        var ltOM = document.getElementById("ltOutModel").value;
        var momentOM = moment(DAppDig);
        momentOM.add(ltOM, 'days');
        var DtOutModel = momentOM.toDate();
        DtOutModel = adjustForWeekends(DtOutModel);
        document.getElementById("DtOutModel").value = formatDate(DtOutModel);
        var dayOutModel = getDayName(DtOutModel, "en-EN");
        document.getElementById("dayOutModel").value = dayOutModel;

        //Sample Ready To Sent
        var ltSRTS = document.getElementById("ltSRTS").value;
        var momentSRTS = moment(DtOutModel);
        momentSRTS.add(ltSRTS, 'days');
        var DtSRTS = momentSRTS.toDate();
        DtSRTS = adjustForWeekends(DtSRTS);
        document.getElementById("DtSRTS").value = formatDate(DtSRTS);
        var daySRTS = getDayName(DtSRTS, "en-EN");
        document.getElementById("daySRTS").value = daySRTS;

        // Check if CR/FPR is combined or not
        var crfpr = document.getElementById("CRFPR").checked;
        console.log(crfpr);

        if (crfpr) {
            // If CRFPR is checked, set FPR Meeting date to match CR Meeting date
            var ltCRMeetingn = document.getElementById("ltCRMeeting").value;
            var momentCRMeetn = moment(nextWednesdayCRModelSend);
            momentCRMeetn.add(ltCRMeetingn, 'days');
            var nextThursdayCRMeetingn = getNextThursday(momentCRMeetn.toDate());
            document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayCRMeetingn);
            var dayFPRMeetingn = getDayName(nextThursdayCRMeetingn, "en-EN");
            document.getElementById("dayFPRMeeting").value = dayFPRMeetingn;

            document.getElementById("dateFPR").value = document.getElementById("dateCR").value;
            document.getElementById("dateFPRModelReady").value = document.getElementById("dateCRModel").value;
            document.getElementById("dateFPRPack").value = document.getElementById("dateCRPac").value;
            document.getElementById("dateFPRModel").value = document.getElementById("dateCRModelW").value;
            document.getElementById("dateFPRModelSend").value = document.getElementById("dateCRModelSend").value;

            //Final Part Geometry Start
            var ltFPGS = document.getElementById("ltFPGS").value;
            var momentFPGS = moment(nextThursdayCRMeetingn);
            momentFPGS.subtract(ltFPGS, 'days');
            var DtFPGS = momentFPGS.toDate();
            DtFPGS = adjustForWeekends(DtFPGS);
            document.getElementById("DtFPGS").value = formatDate(DtFPGS);
            var dayFPGS = getDayName(DtFPGS, "en-EN");
            document.getElementById("dayFPGS").value = dayFPGS;

            //Final Part Geometry Finish
            var ltFPGF = document.getElementById("ltFPGF").value;
            var momentFPGF = moment(nextThursdayCRMeetingn);
            momentFPGF.subtract(ltFPGF, 'days');
            var DtFPGF = momentFPGF.toDate();
            DtFPGF = adjustForWeekends(DtFPGF);
            document.getElementById("DtFPGF").value = formatDate(DtFPGF);
            var dayFPGF = getDayName(DtFPGF, "en-EN");
            document.getElementById("dayFPGF").value = dayFPGF;

            document.getElementById("note").textContent = "FPR Dates are the same as CR Dates";
        } else {
            // If CRFPR is not checked, FPR Meeting will be 7D after FPR Model Send
            var ltFPRMeetingn = document.getElementById("ltFPRMeeting").value;
            var momentFPRMeetn = moment(nextWednesdayFPRModelSend);
            momentFPRMeetn.add(ltFPRMeetingn, 'days');
            var nextThursdayFPRMeetingn = getNextThursday(momentFPRMeetn.toDate());
            document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayFPRMeetingn);
            var dayFPRMeetingn = getDayName(nextThursdayFPRMeetingn, "en-EN");
            document.getElementById("dayFPRMeeting").value = dayFPRMeetingn;

            //Final Part Geometry Start
            var ltFPGS = document.getElementById("ltFPGS").value;
            var momentFPGS = moment(nextThursdayFPRMeetingn);
            momentFPGS.subtract(ltFPGS, 'days');
            var DtFPGS = momentFPGS.toDate();
            DtFPGS = adjustForWeekends(DtFPGS);
            document.getElementById("DtFPGS").value = formatDate(DtFPGS);
            var dayFPGS = getDayName(DtFPGS, "en-EN");
            document.getElementById("dayFPGS").value = dayFPGS;

            //Final Part Geometry Finish
            var ltFPGF = document.getElementById("ltFPGF").value;
            var momentFPGF = moment(nextThursdayFPRMeetingn);
            momentFPGF.subtract(ltFPGF, 'days');
            var DtFPGF = momentFPGF.toDate();
            DtFPGF = adjustForWeekends(DtFPGF);
            document.getElementById("DtFPGF").value = formatDate(DtFPGF);
            var dayFPGF = getDayName(DtFPGF, "en-EN");
            document.getElementById("dayFPGF").value = dayFPGF;

            document.getElementById("note").textContent = "";
        }
    } else {
        toolingActivitySection.style.display = 'none';
    }
    // -- End of Check Tooling Budget --

    // -- Brand Conditional Statement --
    var brandSelect = document.getElementById('Categories');
    var selectedBrand = brandSelect.value;
    console.log(selectedBrand);
    var dspLabelElement = document.getElementById('dspLabelElement');
    var dspFinishRow = document.getElementById('dspFinishRow');
    var crPackoutRow = document.getElementById('crPackoutRow');
    var fprPackoutRow = document.getElementById('fprPackoutRow');
    var decoAppRow = document.getElementById('decoAppRow');

    dspLabelElement.textContent = 'DSP Start (turnover to Plant)';
    // Show the non-displayed row
    dspFinishRow.style.display = 'flex';
    crPackoutRow.style.display = 'flex';
    fprPackoutRow.style.display = 'flex';
    decoAppRow.style.display = 'none';

    // -- If Brand is Signature --
    if (selectedBrand === 'Signature') {
        dspLabelElement.textContent = 'DSP Finish (Control Drawing & Artwork Complete)';

        // Hide unrelatable row
        dspFinishRow.style.display = 'none';
        crPackoutRow.style.display = 'none';
        fprPackoutRow.style.display = 'none';
        decoAppRow.style.display = 'none';

        // Start Date - DSP Finish
        var startDSPFin = document.getElementById("start");
        if (!isValidDate(startDSPFin.value)) {
            // Handle invalid date case, e.g., display an error message
            return;
        }
        var startDSPF = new Date(startDSPFin.value);
        console.log("Start:", startDSPF);
        var dayDSPF = getDayName(startDSPF, "en-EN");
        document.getElementById("startDay").value = dayDSPF;

        //KO Meeting
        var ltKO = document.getElementById("ltKO").value;
        var momentStart = moment(startDSPF);
        momentStart.add(ltKO, 'days');
        var dateKO = momentStart.toDate();
        dateKO = adjustForWeekends(dateKO);
        document.getElementById("dateKO").value = formatDate(dateKO);
        var dayKO = getDayName(dateKO, "en-EN");
        document.getElementById("dayKO").value = dayKO;

        //Fitting Submission
        var ltFS = document.getElementById("ltFS").value;
        var momentFS = moment(dateKO);
        momentFS.add(ltFS, 'days');
        var dateFS = momentFS.toDate();
        dateFS = adjustForWeekends(dateFS);
        document.getElementById("dateFS").value = formatDate(dateFS);
        var dayFS = getDayName(dateFS, "en-EN");
        document.getElementById("dayFS").value = dayFS;

        //BOM Input 
        var ltBOM = document.getElementById("ltBOM").value;
        var momentBOM = moment(dateFS);
        momentBOM.add(ltBOM, 'days');
        var dateBOM = momentBOM.toDate();
        dateBOM = adjustForWeekends(dateBOM);
        document.getElementById("dateBOM").value = formatDate(dateBOM);
        var dayBOM = getDayName(dateBOM, "en-EN");
        document.getElementById("dayBOM").value = dayBOM;

        //1st Cost Internal
        var lt1st = document.getElementById("lt1st").value;
        var moment1stCostI = moment(dateBOM);
        moment1stCostI.add(lt1st, 'days');
        var date1st = moment1stCostI.toDate();
        date1st = adjustForWeekends(date1st);
        document.getElementById("date1st").value = formatDate(date1st);
        var day1st = getDayName(date1st, "en-EN");
        document.getElementById("day1st").value = day1st;

        //1st Cost ES
        var lt1stCost = document.getElementById("lt1stCost").value;
        var moment1stCostES = moment(date1st);
        moment1stCostES.add(lt1stCost, 'days');
        var date1stCost = moment1stCostES.toDate();
        date1stCost = adjustForWeekends(date1stCost);
        document.getElementById("date1stCost").value = formatDate(date1stCost);
        var day1stCost = getDayName(date1stCost, "en-EN");
        document.getElementById("day1stCost").value = day1stCost;

        //CR Cost Done
        var ltCR = document.getElementById("ltCR").value;
        var momentCRCostDone = moment(date1stCost);
        momentCRCostDone.add(ltCR, 'days');
        var dateCR = momentCRCostDone.toDate();
        dateCR = adjustForWeekends(dateCR);
        document.getElementById("dateCR").value = formatDate(dateCR);
        var dayCR = getDayName(dateCR, "en-EN");
        document.getElementById("dayCR").value = dayCR;

        //CR Model Ready
        var ltCRModel = document.getElementById("ltCRModel").value;
        var momentCRMR = moment(dateCR);
        momentCRMR.add(ltCRModel, 'days');
        var dateCRModel = momentCRMR.toDate();
        dateCRModel = adjustForWeekends(dateCRModel);
        document.getElementById("dateCRModel").value = formatDate(dateCRModel);
        var dayCRModel = getDayName(dateCRModel, "en-EN");
        document.getElementById("dayCRModel").value = dayCRModel;

        //CR Model Walkthrough
        var ltCRModelW = document.getElementById("ltCRModelW").value;
        var momentCRMW = moment(dateCRModel);
        momentCRMW.add(ltCRModelW, 'days');
        var dateCRModelW = momentCRMW.toDate();
        dateCRModelW = adjustForWeekends(dateCRModelW);
        document.getElementById("dateCRModelW").value = formatDate(dateCRModelW);
        var dayCRModelW = getDayName(dateCRModelW, "en-EN");
        document.getElementById("dayCRModelW").value = dayCRModelW;

        //CR Model Send
        var ltCRModelSend = document.getElementById("ltCRModelSend").value;
        var momentCRModelS = moment(dateCRModelW);
        momentCRModelS.add(ltCRModelSend, 'days');
        var nextWednesdayCRModelSends = getNextWednesday(momentCRModelS.toDate());
        document.getElementById("dateCRModelSend").value = formatISOString(nextWednesdayCRModelSends);
        var dayCRModelSend = getDayName(nextWednesdayCRModelSends, "en-EN");
        document.getElementById("dayCRModelSend").value = dayCRModelSend;

        //CR Meeting
        var ltCRMeeting = document.getElementById("ltCRMeeting").value;
        var momentCRM = moment(nextWednesdayCRModelSends);
        momentCRM.add(ltCRMeeting, 'days');
        var nextThursdayCRMeetings = getNextThursday(momentCRM.toDate());
        document.getElementById("dateCRMeeting").value = formatISOString(nextThursdayCRMeetings);
        var dayCRMeeting = getDayName(nextThursdayCRMeetings, "en-EN");
        document.getElementById("dayCRMeeting").value = dayCRMeeting;

        var licen = document.getElementById("Licensed").checked;
        console.log(licen);

        if (!licen) {
            // FPR Cost Done when Licensed is not checked
            var ltFPRCostDones = document.getElementById("ltFPR").value;
            var momentFPRCostDones = moment(nextThursdayCRMeetings);
            momentFPRCostDones.add(ltFPRCostDones, 'days');
            var fprCostDoneDate = adjustForWeekend(momentFPRCostDones);
            document.getElementById("dateFPR").value = formatDate(fprCostDoneDate.toDate());
            const dayFPRs = getDayName(fprCostDoneDate, "en-EN");
            document.getElementById("dayFPR").value = dayFPRs;

            var licensorApprovalRow = document.getElementById("licensorApprovalRow");
            licensorApprovalRow.style.display = "none";
        }

        //Licensor Approval
        var ltLAs = document.getElementById("ltLA").value;
        var momentCRMeeting = moment(nextThursdayCRMeetings);
        momentCRMeeting.add(ltLAs, 'days');
        console.log(ltLAs);
        var dateLa = new Date(momentCRMeeting.format("yyyy-MM-DD"));
        dateLa = adjustForWeekends(dateLa);
        document.getElementById("dateLA").value = formatDate(dateLa);
        var dayLa = getDayName(dateLa, "en-EN");
        document.getElementById("dayLA").value = dayLa;

        if (licen) {
            // FPR Cost Done when Licensed is checked
            console.log(ltLAs);

            var ltFPRCostDone = document.getElementById("ltFPR").value;
            var momentFPRCostDone = moment(dateLa);
            momentFPRCostDone.add(ltFPRCostDone, 'days');
            var fprCostDoneDate = adjustForWeekend(momentFPRCostDone);
            document.getElementById("dateFPR").value = formatDate(fprCostDoneDate.toDate());
            const dayFPR = getDayName(fprCostDoneDate, "en-EN");
            document.getElementById("dayFPR").value = dayFPR;

            var licensorApprovalRow = document.getElementById("licensorApprovalRow");
            licensorApprovalRow.style.display = "flex";
        }

        // FPR Model Ready
        var ltFPRModelReady = document.getElementById("ltFPRModelReady").value;
        var momentFPRModelReady = moment(fprCostDoneDate);
        momentFPRModelReady.add(ltFPRModelReady, 'days');
        var fprModelReadyDate = adjustForWeekend(momentFPRModelReady);
        document.getElementById("dateFPRModelReady").value = formatDate(fprModelReadyDate.toDate());
        var dayFPRModelReady = getDayName(fprModelReadyDate, "en-EN");
        document.getElementById("dayFPRModelReady").value = dayFPRModelReady;

        // FPR Model Walkthrough
        var ltFPRModels = document.getElementById("ltFPRModel").value;
        var momentFPRModelWT = moment(fprModelReadyDate);
        momentFPRModelWT.add(ltFPRModels, 'days');
        var fprModelWT = adjustForWeekend(momentFPRModelWT);
        document.getElementById("dateFPRModel").value = formatDate(fprModelWT.toDate());
        var dayFPRModel = getDayName(fprModelWT, "en-EN");
        document.getElementById("dayFPRModel").value = dayFPRModel;

        //FPR Model Send
        var ltFPRModelSend = document.getElementById("ltFPRModelSend").value;
        var momentFPRModel = moment(fprModelWT);
        momentFPRModel.add(ltFPRModelSend, 'days');
        var nextWednesdayFPRModelSends = getNextWednesday(momentFPRModel.toDate());
        document.getElementById("dateFPRModelSend").value = formatISOString(nextWednesdayFPRModelSends);
        var dayFPRModelSend = getDayName(nextWednesdayFPRModelSends, "en-EN");
        document.getElementById("dayFPRModelSend").value = dayFPRModelSend;

        // Check if CR/FPR is combined or not
        var crfpr = document.getElementById("CRFPR").checked;
        console.log(crfpr);

        if (crfpr) {
            // If CRFPR is checked, set FPR Meeting date to match CR Meeting date
            var ltCRMeetings = document.getElementById("ltCRMeeting").value;
            var momentCRMeets = moment(nextWednesdayCRModelSends);
            momentCRMeets.add(ltCRMeetings, 'days');
            var nextThursdayCRMeetings = getNextThursday(momentCRMeets.toDate());
            document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayCRMeetings);
            var dayFPRMeetings = getDayName(nextThursdayCRMeetings, "en-EN");
            document.getElementById("dayFPRMeeting").value = dayFPRMeetings;

            document.getElementById("dateFPR").value = document.getElementById("dateCR").value;
            document.getElementById("dateFPRModelReady").value = document.getElementById("dateCRModel").value;
            document.getElementById("dateFPRPack").value = document.getElementById("dateCRPac").value;
            document.getElementById("dateFPRModel").value = document.getElementById("dateCRModelW").value;
            document.getElementById("dateFPRModelSend").value = document.getElementById("dateCRModelSend").value;

            document.getElementById("note").textContent = "FPR Dates are the same as CR Dates";
        } else {
            // If CRFPR is not checked, FPR Meeting will be 7D after FPR Model Send
            var ltFPRMeeting = document.getElementById("ltFPRMeeting").value;
            var momentFPRMeet = moment(nextWednesdayFPRModelSends);
            momentFPRMeet.add(ltFPRMeeting, 'days');
            var nextThursdayFPRMeeting = getNextThursday(momentFPRMeet.toDate());
            document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayFPRMeeting);
            var dayFPRMeetings = getDayName(nextThursdayFPRMeeting, "en-EN");
            document.getElementById("dayFPRMeeting").value = dayFPRMeetings;

            document.getElementById("note").textContent = "";
        }

        // -- Start Check Tooling Budget is null or not: If Brand = Signature
        var toolingBudgetInput = document.getElementById("ToolBdg").value;
        console.log(toolingBudgetInput);

        var toolingActivitySection = document.getElementById("collapseTooling");

        if (toolingBudgetInput == 0) {
            toolingActivitySection.style.display = 'none';
        } else if (toolingBudgetInput > 0) {
            toolingActivitySection.style.display = 'flex';

            //CDI
            var ltCDIS = 2;
            var momentCDIS = moment(startDSPF);
            momentCDIS.add(ltCDIS, 'days');
            var DtCDIS = momentCDIS.toDate();
            DtCDIS = adjustForWeekends(DtCDIS);
            document.getElementById("DtCDI").value = formatDate(DtCDIS);
            var dayCDIS = getDayName(DtCDIS, "en-EN");
            document.getElementById("dayCDI").value = dayCDIS;

            //1st Digital Review
            var ltDRS = document.getElementById("lt1stDR").value;
            var momentDRS = moment(startDSPF);
            momentDRS.add(ltDRS, 'days');
            var Dt1stDRS = momentDRS.toDate();
            Dt1stDRS = adjustForWeekends(Dt1stDRS);
            document.getElementById("Dt1stDR").value = formatDate(Dt1stDRS);
            var day1stDRS = getDayName(Dt1stDRS, "en-EN");
            document.getElementById("day1stDR").value = day1stDRS;

            //Approved Digital
            var ltADS = document.getElementById("ltAppDig").value;
            var momentADS = moment(Dt1stDRS);
            momentADS.add(ltADS, 'days');
            var DAppDigS = momentADS.toDate();
            DAppDigS = adjustForWeekends(DAppDigS);
            document.getElementById("DAppDig").value = formatDate(DAppDigS);
            var dayAppDigS = getDayName(DAppDigS, "en-EN");
            document.getElementById("dayAppDig").value = dayAppDigS;

            //Output Model
            var ltOMS = document.getElementById("ltOutModel").value;
            var momentOMS = moment(DAppDigS);
            momentOMS.add(ltOMS, 'days');
            var DtOutModelS = momentOMS.toDate();
            DtOutModelS = adjustForWeekends(DtOutModelS);
            document.getElementById("DtOutModel").value = formatDate(DtOutModelS);
            var dayOutModelS = getDayName(DtOutModelS, "en-EN");
            document.getElementById("dayOutModel").value = dayOutModelS;

            //Sample Ready To Sent
            var ltSRTSS = document.getElementById("ltSRTS").value;
            var momentSRTSS = moment(DtOutModelS);
            momentSRTSS.add(ltSRTSS, 'days');
            var DtSRTSS = momentSRTSS.toDate();
            DtSRTSS = adjustForWeekends(DtSRTSS);
            document.getElementById("DtSRTS").value = formatDate(DtSRTSS);
            var daySRTSS = getDayName(DtSRTSS, "en-EN");
            document.getElementById("daySRTS").value = daySRTSS;

            if (crfpr) {
                // If CRFPR is checked, set FPR Meeting date to match CR Meeting date
                var ltCRMeetings = document.getElementById("ltCRMeeting").value;
                var momentCRMeets = moment(nextWednesdayCRModelSends);
                momentCRMeets.add(ltCRMeetings, 'days');
                var nextThursdayCRMeetings = getNextThursday(momentCRMeets.toDate());
                document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayCRMeetings);
                var dayFPRMeetings = getDayName(nextThursdayCRMeetings, "en-EN");
                document.getElementById("dayFPRMeeting").value = dayFPRMeetings;

                document.getElementById("dateFPR").value = document.getElementById("dateCR").value;
                document.getElementById("dateFPRModelReady").value = document.getElementById("dateCRModel").value;
                document.getElementById("dateFPRPack").value = document.getElementById("dateCRPac").value;
                document.getElementById("dateFPRModel").value = document.getElementById("dateCRModelW").value;
                document.getElementById("dateFPRModelSend").value = document.getElementById("dateCRModelSend").value;

                //Final Part Geometry Start
                var ltFPGSSG = document.getElementById("ltFPGS").value;
                var momentFPGSSG = moment(nextThursdayCRMeetings);
                momentFPGSSG.subtract(ltFPGSSG, 'days');
                var DtFPGSSG = momentFPGSSG.toDate();
                DtFPGSSG = adjustForWeekends(DtFPGSSG);
                document.getElementById("DtFPGS").value = formatDate(DtFPGSSG);
                var dayFPGSSG = getDayName(DtFPGSSG, "en-EN");
                document.getElementById("dayFPGS").value = dayFPGSSG;

                //Final Part Geometry Finish
                var ltFPGFSG = document.getElementById("ltFPGF").value;
                var momentFPGFSG = moment(nextThursdayCRMeetings);
                momentFPGFSG.subtract(ltFPGFSG, 'days');
                var DtFPGFSG = momentFPGFSG.toDate();
                DtFPGFSG = adjustForWeekends(DtFPGFSG);
                document.getElementById("DtFPGF").value = formatDate(DtFPGFSG);
                var dayFPGFSG = getDayName(DtFPGF, "en-EN");
                document.getElementById("dayFPGF").value = dayFPGFSG;

                document.getElementById("note").textContent = "FPR Dates are the same as CR Dates";
            } else {
                // If CRFPR is not checked, FPR Meeting will be 7D after FPR Model Send
                var ltFPRMeeting = document.getElementById("ltFPRMeeting").value;
                var momentFPRMeet = moment(nextWednesdayFPRModelSends);
                momentFPRMeet.add(ltFPRMeeting, 'days');
                var nextThursdayFPRMeeting = getNextThursday(momentFPRMeet.toDate());
                document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayFPRMeeting);
                var dayFPRMeetings = getDayName(nextThursdayFPRMeeting, "en-EN");
                document.getElementById("dayFPRMeeting").value = dayFPRMeetings;

                //Final Part Geometry Start
                var ltFPGSS = document.getElementById("ltFPGS").value;
                var momentFPGSS = moment(nextThursdayFPRMeeting);
                momentFPGSS.subtract(ltFPGSS, 'days');
                var DtFPGSS = momentFPGSS.toDate();
                DtFPGSS = adjustForWeekends(DtFPGSS);
                document.getElementById("DtFPGS").value = formatDate(DtFPGSS);
                var dayFPGS = getDayName(DtFPGSS, "en-EN");
                document.getElementById("dayFPGS").value = dayFPGS;

                //Final Part Geometry Finish
                var ltFPGFS = document.getElementById("ltFPGF").value;
                var momentFPGFS = moment(nextThursdayFPRMeeting);
                momentFPGFS.subtract(ltFPGFS, 'days');
                var DtFPGFS = momentFPGFS.toDate();
                DtFPGFS = adjustForWeekends(DtFPGFS);
                document.getElementById("DtFPGF").value = formatDate(DtFPGFS);
                var dayFPGFS = getDayName(DtFPGFS, "en-EN");
                document.getElementById("dayFPGF").value = dayFPGFS;

                document.getElementById("note").textContent = "";
            }
        }
    }

    // -- If Brand is Disney --
    if (selectedBrand === 'Disney Princess' || selectedBrand === 'Frozen' || selectedBrand === 'Disney Collector' || selectedBrand === 'Daylight' || selectedBrand === 'Scallop') {
        dspLabelElement.textContent = 'DSP Start (turnover to Plant)';
        document.getElementById('start').onchange = startDate;

        var licensorApprovalRow = document.getElementById("licensorApprovalRow");
        licensorApprovalRow.style.display = "flex";

        // Show the non-displayed row
        dspFinishRow.style.display = 'flex';
        crPackoutRow.style.display = 'flex';
        fprPackoutRow.style.display = 'flex';
        decoAppRow.style.display = 'flex';

        //CR Meeting
        var ltCRMeet = document.getElementById("ltCRMeeting").value;
        var momentCRMs = moment(nextWednesdayCRModelSend);
        momentCRMs.add(ltCRMeet, 'days');
        var nextThursdayCRMeet = getNextThursday(momentCRMs.toDate());
        document.getElementById("dateCRMeeting").value = formatISOString(nextThursdayCRMeet);
        var dayCRMeet = getDayName(nextThursdayCRMeet, "en-EN");
        document.getElementById("dayCRMeeting").value = dayCRMeet;

        // Licensor Approval
        var ltLAInput = 21;
        document.getElementById("ltLA").value = ltLAInput;
        var momentLicen = moment(nextThursdayCRMeet);
        momentLicen.add(ltLAInput, 'days');
        console.log(ltLAInput);
        var dateLAs = new Date(momentLicen.format("yyyy-MM-DD"));
        dateLAs = adjustForWeekends(dateLAs);
        document.getElementById("dateLA").value = formatDate(dateLAs);
        var dayLAs = getDayName(dateLAs, "en-EN");
        document.getElementById("dayLA").value = dayLAs;

        // FPR Cost Done
        var ltFPRCostDone = document.getElementById("ltFPR").value;
        var momentFPRCostDone = moment(dateLAs);
        momentFPRCostDone.add(ltFPRCostDone, 'days');
        var fprCostDoneDate = adjustForWeekend(momentFPRCostDone);
        document.getElementById("dateFPR").value = formatDate(fprCostDoneDate.toDate());
        var dayFPR = getDayName(fprCostDoneDate, "en-EN");
        document.getElementById("dayFPR").value = dayFPR;

        //FPR Model Send
        var ltFPRModelSendS = document.getElementById("ltFPRModelSend").value;
        var momentFPRModelS = moment(fprModelWT);
        momentFPRModelS.add(ltFPRModelSendS, 'days');
        var nextWednesdayFPRModelSendS = getNextWednesday(momentFPRModelS.toDate());
        document.getElementById("dateFPRModelSend").value = formatISOString(nextWednesdayFPRModelSendS);
        var dayFPRModelSends = getDayName(nextWednesdayFPRModelSendS, "en-EN");
        document.getElementById("dayFPRModelSend").value = dayFPRModelSends;

        // Deco Approval
        var ltDecoApp = document.getElementById("ltDecoApp").value;
        var momentDecoApp = moment(nextWednesdayFPRModelSendS);
        momentDecoApp.add(ltDecoApp, 'days');
        var decoApp = adjustForWeekend(momentDecoApp);
        document.getElementById("dateDecoApp").value = formatDate(decoApp.toDate());
        var dayDecoApp = getDayName(decoApp, "en-EN");
        document.getElementById("dayDecoApp").value = dayDecoApp;

        // Check if CR/FPR is combined or not
        var crfpr = document.getElementById("CRFPR").checked;
        console.log(crfpr);

        if (crfpr) {
            // If CRFPR is checked, set FPR Meeting date to match CR Meeting date
            var ltCRMt = document.getElementById("ltCRMeeting").value;
            var momentCRMt = moment(nextWednesdayCRModelSend);
            momentCRMt.add(ltCRMt, 'days');
            var nextThursdayCRMt = getNextThursday(momentCRMt.toDate());
            document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayCRMt);
            var dayFPRMt = getDayName(nextThursdayCRMt, "en-EN");
            document.getElementById("dayFPRMeeting").value = dayFPRMt;

            document.getElementById("dateFPR").value = document.getElementById("dateCR").value;
            document.getElementById("dateFPRModelReady").value = document.getElementById("dateCRModel").value;
            document.getElementById("dateFPRPack").value = document.getElementById("dateCRPac").value;
            document.getElementById("dateFPRModel").value = document.getElementById("dateCRModelW").value;
            document.getElementById("dateFPRModelSend").value = document.getElementById("dateCRModelSend").value;

            // Deco Approval
            var ltDecoApp = document.getElementById("ltDecoApp").value;
            var momentDecoApp = moment(document.getElementById("dateFPRModelSend").value);
            momentDecoApp.add(ltDecoApp, 'days');
            var decoApp = adjustForWeekend(momentDecoApp);
            document.getElementById("dateDecoApp").value = formatDate(decoApp.toDate());
            var dayDecoApp = getDayName(decoApp, "en-EN");
            document.getElementById("dayDecoApp").value = dayDecoApp;

            document.getElementById("note").textContent = "FPR Dates are the same as CR Dates";
        } else {
            // If CRFPR is not checked, FPR Meeting will be 7D after FPR Model Send
            var ltFPRMt = document.getElementById("ltFPRMeeting").value;
            var momentFPRMt = moment(decoApp);
            momentFPRMt.add(ltFPRMt, 'days');
            var nextThursdayFPRMt = getNextThursday(momentFPRMt.toDate());
            document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayFPRMt);
            var dayFPRMt = getDayName(nextThursdayFPRMt, "en-EN");
            document.getElementById("dayFPRMeeting").value = dayFPRMt;

            document.getElementById("note").textContent = "";
        }

        // -- Start Check Tooling Budget is null or not: If Brand = Disney
        var toolingBudgetInput = document.getElementById("ToolBdg").value;
        console.log(toolingBudgetInput);

        var toolingActivitySection = document.getElementById("collapseTooling");

        if (toolingBudgetInput == 0) {
            toolingActivitySection.style.display = 'none';
        } else if (toolingBudgetInput > 0) {
            toolingActivitySection.style.display = 'flex';

            //CDI
            var ltCDID = document.getElementById("ltCDI").value;
            var momentCDID = moment(dateDSF);
            momentCDID.add(ltCDID, 'days');
            var DtCDID = momentCDID.toDate();
            DtCDID = adjustForWeekends(DtCDID);
            document.getElementById("DtCDI").value = formatDate(DtCDID);
            var dayCDID = getDayName(DtCDID, "en-EN");
            document.getElementById("dayCDI").value = dayCDID;

            //1st Digital Review
            var ltDRD = document.getElementById("lt1stDR").value;
            var momentDRD = moment(dateDSF);
            momentDRD.add(ltDRD, 'days');
            var Dt1stDRD = momentDRD.toDate();
            Dt1stDRD = adjustForWeekends(Dt1stDRD);
            document.getElementById("Dt1stDR").value = formatDate(Dt1stDRD);
            var day1stDRD = getDayName(Dt1stDRD, "en-EN");
            document.getElementById("day1stDR").value = day1stDRD;

            //Approved Digital
            var ltADD = document.getElementById("ltAppDig").value;
            var momentADD = moment(Dt1stDRD);
            momentADD.add(ltADD, 'days');
            var DAppDigD = momentADD.toDate();
            DAppDigD = adjustForWeekends(DAppDigD);
            document.getElementById("DAppDig").value = formatDate(DAppDigD);
            var dayAppDigD = getDayName(DAppDigD, "en-EN");
            document.getElementById("dayAppDig").value = dayAppDigD;

            //Output Model
            var ltOMD = document.getElementById("ltOutModel").value;
            var momentOMD = moment(DAppDigD);
            momentOMD.add(ltOMD, 'days');
            var DtOutModelD = momentOMD.toDate();
            DtOutModelD = adjustForWeekends(DtOutModelD);
            document.getElementById("DtOutModel").value = formatDate(DtOutModelD);
            var dayOutModelD = getDayName(DtOutModelD, "en-EN");
            document.getElementById("dayOutModel").value = dayOutModelD;

            //Sample Ready To Sent
            var ltSRTSD = document.getElementById("ltSRTS").value;
            var momentSRTSD = moment(DtOutModel);
            momentSRTSD.add(ltSRTSD, 'days');
            var DtSRTSD = momentSRTSD.toDate();
            DtSRTSD = adjustForWeekends(DtSRTSD);
            document.getElementById("DtSRTS").value = formatDate(DtSRTSD);
            var daySRTSD = getDayName(DtSRTSD, "en-EN");
            document.getElementById("daySRTS").value = daySRTSD;

            if (crfpr) {
                // If CRFPR is checked, set FPR Meeting date to match CR Meeting date
                var ltCRMtd = document.getElementById("ltCRMeeting").value;
                var momentCRMtd = moment(nextWednesdayCRModelSend);
                momentCRMtd.add(ltCRMtd, 'days');
                var nextThursdayCRMtd = getNextThursday(momentCRMtd.toDate());
                document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayCRMtd);
                var dayFPRMtd = getDayName(nextThursdayCRMtd, "en-EN");
                document.getElementById("dayFPRMeeting").value = dayFPRMtd;

                document.getElementById("dateFPR").value = document.getElementById("dateCR").value;
                document.getElementById("dateFPRModelReady").value = document.getElementById("dateCRModel").value;
                document.getElementById("dateFPRPack").value = document.getElementById("dateCRPac").value;
                document.getElementById("dateFPRModel").value = document.getElementById("dateCRModelW").value;
                document.getElementById("dateFPRModelSend").value = document.getElementById("dateCRModelSend").value;

                // Deco Approval
                var ltDecoAppd = document.getElementById("ltDecoApp").value;
                var momentDecoAppd = moment(document.getElementById("dateFPRModelSend").value);
                momentDecoAppd.add(ltDecoAppd, 'days');
                var decoAppd = adjustForWeekend(momentDecoAppd);
                document.getElementById("dateDecoApp").value = formatDate(decoAppd.toDate());
                var dayDecoAppd = getDayName(decoAppd, "en-EN");
                document.getElementById("dayDecoApp").value = dayDecoAppd;

                //Final Part Geometry Start
                var ltFPGSd = document.getElementById("ltFPGS").value;
                var momentFPGSd = moment(nextThursdayCRMtd);
                momentFPGSd.subtract(ltFPGSd, 'days');
                var DtFPGSd = momentFPGSd.toDate();
                DtFPGSd = adjustForWeekends(DtFPGS);
                document.getElementById("DtFPGS").value = formatDate(DtFPGSd);
                var dayFPGSd = getDayName(DtFPGSd, "en-EN");
                document.getElementById("dayFPGS").value = dayFPGSd;

                //Final Part Geometry Finish
                var ltFPGFd = document.getElementById("ltFPGF").value;
                var momentFPGFd = moment(nextThursdayCRMtd);
                momentFPGFd.subtract(ltFPGFd, 'days');
                var DtFPGFd = momentFPGFd.toDate();
                DtFPGFd = adjustForWeekends(DtFPGFd);
                document.getElementById("DtFPGF").value = formatDate(DtFPGFd);
                var dayFPGFd = getDayName(DtFPGFd, "en-EN");
                document.getElementById("dayFPGF").value = dayFPGFd;

                document.getElementById("note").textContent = "FPR Dates are the same as CR Dates";
            } else {
                // If CRFPR is not checked, FPR Meeting will be 7D after FPR Model Send
                var ltFPRMtd = document.getElementById("ltFPRMeeting").value;
                var momentFPRMtd = moment(decoApp);
                momentFPRMtd.add(ltFPRMtd, 'days');
                var nextThursdayFPRMtd = getNextThursday(momentFPRMtd.toDate());
                document.getElementById("dateFPRMeeting").value = formatISOString(nextThursdayFPRMtd);
                var dayFPRMtd = getDayName(nextThursdayFPRMtd, "en-EN");
                document.getElementById("dayFPRMeeting").value = dayFPRMtd;

                //Final Part Geometry Start
                var ltFPGSdsn = document.getElementById("ltFPGS").value;
                var momentFPGSdsn = moment(nextThursdayFPRMtd);
                momentFPGSdsn.subtract(ltFPGSdsn, 'days');
                var DtFPGSdsn = momentFPGSdsn.toDate();
                DtFPGSdsn = adjustForWeekends(DtFPGSdsn);
                document.getElementById("DtFPGS").value = formatDate(DtFPGSdsn);
                var dayFPGSdsn = getDayName(DtFPGSdsn, "en-EN");
                document.getElementById("dayFPGS").value = dayFPGSdsn;

                //Final Part Geometry Finish
                var ltFPGFdsn = document.getElementById("ltFPGF").value;
                var momentFPGFdsn = moment(nextThursdayFPRMtd);
                momentFPGFdsn.subtract(ltFPGFdsn, 'days');
                var DtFPGFdsn = momentFPGFdsn.toDate();
                DtFPGFdsn = adjustForWeekends(DtFPGFdsn);
                document.getElementById("DtFPGF").value = formatDate(DtFPGFdsn);
                var dayFPGFdsn = getDayName(DtFPGFdsn, "en-EN");
                document.getElementById("dayFPGF").value = dayFPGFdsn;

                document.getElementById("note").textContent = "";
            }
        } else {
            toolingActivitySection.style.display = 'none';
        }
        // -- End of Check Tooling Budget --
    }
    // -- End of Brand Conditional Statement --

    // FUNCTIONS ~
    function adjustForWeekends(date) {
        if (date instanceof moment) {
            date = date.toDate();
        }

        var dayName = getDayName(date, "en-EN");
        if (dayName === "Saturday") {
            // Show a warning dialog if it's Saturday
            //Swal.fire({
            //    title: "Warning",
            //    text: "Date cannot fall on a Saturday",
            //    icon: "warning"
            //});
            date.setDate(date.getDate() + 2);
        } else if (dayName === "Sunday") {
            //    // Show a warning dialog if it's Sunday
            //    Swal.fire({
            //        title: "Warning",
            //        text: "Date cannot fall on a Sunday",
            //        icon: "warning"
            //    });
            date.setDate(date.getDate() + 1);
        }
        return date;
    }

    function adjustForWeekend(date) {
        var dayName = getDayName(date, "en-EN");
        if (dayName === "Saturday") {
            date.setDate(date.getDate() + 2);
        } else if (dayName === "Sunday") {
            date.setDate(date.getDate() + 1);
        }
        return date;
    }

    function formatDate(date) {
        var year = date.getFullYear();
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var day = date.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function formatISOString(date) {
        return date.toISOString().split('T')[0];
    }

    function getNextWednesday(date) {
        var nextWednesday = new Date(date);
        nextWednesday.setDate(nextWednesday.getDate() + (3 + 7 - nextWednesday.getDay()) % 7); // 3 corresponds to Wednesday
        return nextWednesday;
    }

    function getNextThursday(date) {
        var nextThursday = new Date(date);
        nextThursday.setDate(nextThursday.getDate() + (4 + 7 - nextThursday.getDay()) % 7); // 4 corresponds to Thursday
        return nextThursday;
    }
    // END OF FUNCTIONS ~

    // -- Count Total Weeks --
    var dspfDate = document.getElementById("dateDSF");
    var dspsDate = document.getElementById("start");
    var endDateValue = document.getElementById("dateFPRMeeting").value;

    if (dspfDate && dspfDate.value) {
        var endDate = new Date(endDateValue);
        var startDate;

        if (selectedBrand === 'Signature') {
            if (dspsDate && dspsDate.value) {
                startDate = new Date(dspsDate.value);
            } else {
                console.log("DSPS date is missing or empty.");
                return;
            }
        } else {
            startDate = new Date(dspfDate.value);
        }

        var timeDifference = endDate - startDate;
        var weeksDifference = timeDifference / (1000 * 60 * 60 * 24 * 7);
        weeksDifference = weeksDifference.toFixed(2);
        console.log("Total weeks:", weeksDifference);

        document.getElementById("weeksDifferenceValue").textContent = "DSPF - FPR = " + weeksDifference + " Weeks";
    } else {
        console.log("Start date is missing or empty.");
    }
    // -- End of Count Total Weeks --

    // -- Count SLA --
    var brandSelect = document.getElementById('Categories');
    var licensedCheckbox = document.getElementById('Licensed');
    var slaDisplay = document.getElementById('SLA');

    function calculateSLA() {
        var selectedBrand = brandSelect.value;
        var isLicensed = licensedCheckbox.checked;

        var sla;

        if (selectedBrand === 'Signature' || selectedBrand === 'Disney Collector') {
            sla = 26;
        } else if (selectedBrand === 'Disney Princess' || selectedBrand === 'Frozen' || selectedBrand === 'Daylight' || selectedBrand === 'Scallop' ||
            selectedBrand === 'Career' || selectedBrand === 'Color Reveal' || selectedBrand === 'Customized' || selectedBrand === 'Entertainment' ||
            selectedBrand === 'Estate' || selectedBrand === 'Extra' || selectedBrand === 'FAB' || selectedBrand === 'Fairy' || selectedBrand === 'Family') {
            sla = isLicensed ? 20 : 14;
        } else {
            sla = 14;
        }

        slaDisplay.textContent = "SLA DSPF - FPR: " + sla + " Weeks";

        // Calculate the difference
        var difference = weeksDifference - sla;

        // Display the reason delay section and button if the difference is greater than 0
        if (difference > 0) {
            document.getElementById("delayReasonSection").style.display = "block";
            //document.getElementById("saveDelayReason").style.display = "block";
        } else {
            document.getElementById("delayReasonSection").style.display = "none";
            //document.getElementById("saveDelayReason").style.display = "none";
        }

    }

    brandSelect.addEventListener('change', calculateSLA);
    licensedCheckbox.addEventListener('change', calculateSLA);

    // Initial calculation when the page loads
    calculateSLA();
    // -- End of Count SLA --
}
// -- End of startDate() function --
startDate();
updateDates();

function updateDates() {
    var crfpr = document.getElementById("CRFPR").checked;
    var licensed = document.getElementById("Licensed").checked;
    var brand = document.getElementById("Categories").value;
    var toolbdg = document.getElementById("ToolBdg").value;

    console.log("CRFPR:", crfpr);
    console.log("Licensed:", licensed);
    console.log("Categories:", brand);

    startDate(crfpr, licensed, brand, toolbdg);
}

var licensedCheckbox = document.getElementById("Licensed");
licensedCheckbox.addEventListener("change", updateDates);

var toolbudget = document.getElementById("ToolBdg");
toolbudget.addEventListener("change", updateDates);

var crfprCheckbox = document.getElementById("CRFPR");
crfprCheckbox.addEventListener("change", updateDates);

function isValidDate(dateString) {
    var date = new Date(dateString);
    return !isNaN(date);
}
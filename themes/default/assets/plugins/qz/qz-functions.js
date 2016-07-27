
function deployQZ(arch, href) {
    var attributes = {id: "qz", code: 'qz.PrintApplet.class',
        archive: arch, width: 1, height: 1};
    var parameters = {jnlp_href: href,
        cache_option: 'plugin', disable_logging: 'false',
        initial_focus: 'false'};
    if (deployJava.versionCheck("1.7+") == true) {
    }
    else if (deployJava.versionCheck("1.6+") == true) {
        delete parameters['jnlp_href'];
    }
    deployJava.runApplet(attributes, parameters, '1.5');
}

function isLoaded() {
    if (!qz) {
        alert('Error:\n\n\tPrint plugin is NOT loaded!');
        return false;
    } else {
        try {
            if (!qz.isActive()) {
                alert('Error:\n\n\tPrint plugin is loaded but NOT active!');
                return false;
            }
        } catch (err) {
            alert('Error:\n\n\tPrint plugin is NOT loaded properly!');
            return false;
        }
    }
    return true;
}

function qzDonePrinting() {
    if (qz.getException()) {
        alert('Error printing:\n\n\t' + qz.getException().getLocalizedMessage());
        qz.clearException();
        return;
    }

    //console.log('Command successfully sent to "' + qz.getPrinter() + '"');
}

function usePrinter(name) {
    if (isLoaded()) {
        qz.findPrinter(name);
        qz.setEncoding("UTF-8"); // UTF-8
        window['qzDoneFinding'] = function () {
            var printer = qz.getPrinter();
            if (printer === null) {
                alert('Printer: ' + name + 'not found');
            }
            window['qzDoneFinding'] = null;
        };
    }
}

function cutPaper() {
    qz.append(chr(27) + chr(105));   
}
        
function openCashDrawer() {
    qz.append(chr(27) + "\x70" + "\x30" + chr(25) + chr(25) + "\r");
    qz.print();
}

function chr(i) {
    return String.fromCharCode(i);
}

function print(receipt, barcode, drawer) {

    if (receipt) {
        qz.appendHex("x1Bx40");
        qz.append(receipt);
        if(barcode != '') {
            qz.appendImage(barcode, "ESCP");
            while (!qz.isDoneAppending()) {} 
        }
        qz.append("\r\n");
        qz.append("\r\n");
        qz.append("\r\n");
        qz.appendHex("x1Bx40");
        qz.append("\r\n");
        qz.append("\r\n");
        if(drawer != '') {
            qz.appendHex(drawer);
        }
        openCashDrawer();
        cutPaper();
        qz.print();
    }

}

function printData(receipt) {

    if (receipt) {
        qz.appendHex("x1Bx40");
        qz.append(receipt);
        qz.append("\r\n");
        qz.append("\r\n");
        qz.append("\r\n");
        qz.appendHex("x1Bx40");
        qz.append("\r\n");
        qz.append("\r\n");
        cutPaper();
        qz.print();
    }

}

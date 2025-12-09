import { BrowserMultiFormatReader, BarcodeFormat, NotFoundException } from '@zxing/library';
window.BrowserMultiFormatReader = BrowserMultiFormatReader;
window.ZxingNotFoundException = NotFoundException;

var reader = new BrowserMultiFormatReader();
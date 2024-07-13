import os
import sys
import pytesseract
from PIL import Image
import json
import numpy as np
import matplotlib.pyplot as plt
import arabic_reshaper
from bidi.algorithm import get_display

pytesseract.pytesseract.tesseract_cmd = r'C:/Program Files/Tesseract-OCR/tesseract.exe'


tessdata_dir = os.path.join(os.path.dirname(pytesseract.pytesseract.tesseract_cmd), 'tessdata')


def crop_image_pil(image, x1, y1, x2, y2):
    cropped_image = image.crop((x1, y1, x2, y2))
    return cropped_image


def names_arabic_ocr(image_path):
    names2=[]
    with Image.open(image_path) as img:
        cropped_images = [
            #for id
            (740,150, 809,180),
            (459, 180, 810, 250),
            (440, 410, 830, 470),
            (280,280,700,315)
        ]

        ocr_results = []
        for coordinates in cropped_images:
            img_cropped = crop_image_pil(img, *coordinates)
            text_ara = pytesseract.image_to_string(img_cropped, lang='ara', config='--psm 6 ')
            text_eng = pytesseract.image_to_string(img_cropped, lang='eng', config='--psm 6 ')
            if len(text_ara) >= len(text_eng):
                ocr_results.append(text_ara.strip())
            else:
                ocr_results.append(text_eng.strip())
        #print(ocr_results)

        names2.append(ocr_results[0])

        names2.append(ocr_results[1])

        names2.append(ocr_results[2])

        return names2

def dates_arabic_ocr(image_path):
    names2=[]
    with Image.open(image_path) as img:
        cropped_images = [
            #for id
            (740,150, 809,180),
            (459, 180, 810, 250),
            (440, 410, 830, 470),
            (280,280,700,315)
        ]

        ocr_results = []
        for coordinates in cropped_images:
            img_cropped = crop_image_pil(img, *coordinates)
            text_ara = pytesseract.image_to_string(img_cropped, lang='ara', config='--psm 6 ')
            text_eng = pytesseract.image_to_string(img_cropped, lang='eng', config='--psm 6 ')
            if len(text_ara) >= len(text_eng):
                ocr_results.append(text_ara.strip())
            else:
                ocr_results.append(text_eng.strip())
        fourth=ocr_results[3]
        return fourth
        #return ocr_results

#
if __name__ == "__main__":
#     print(f"Arguments received: {sys.argv}")
    if len(sys.argv) != 2:
        print("Usage: python Ocr.py <directory_path>")
        sys.exit(1)

    directory = sys.argv[1]
#     print(f"Received directory: {directory}")

    # Use os.path.join to construct the full paths to the images
    validity_date_image_path = os.path.join(directory, '1(1).png')
    names_image_path = os.path.join(directory, '2.png')

    validity_date = dates_arabic_ocr(validity_date_image_path)
    names = names_arabic_ocr(names_image_path)
    names.append(validity_date)

    print(json.dumps(names))


#
# if __name__ == "__main__":
#     directory = r'C:\\wamp64\\www\\tamweeny\\storage\\app\\public\\uploads\\CardFiles\\محمد نهاد\\nationalIdCardAndBirthCertificate'
#     Validity_Date = dates_arabic_ocr(f'{directory}\\1(1).png')
#     names = names_arabic_ocr(f'{directory}\\2.png')
#     names.append(Validity_Date)
#
#
# print(json.dumps(names))
# print(json.dumps(Validity_Date))


# if __name__ == "__main__":
#     if len(sys.argv) != 2:
#         print("Usage: python Ocr.py <directory_path>")
#         sys.exit(1)
#
#     directory = sys.argv[1]
#
#     # Assuming the filenames are known and fixed
#     validity_date = dates_arabic_ocr(os.path.join(directory, '1(1).png'))
#     names = names_arabic_ocr(os.path.join(directory, '2.png'))
#     names.append(validity_date)
#
#     print(json.dumps(names))

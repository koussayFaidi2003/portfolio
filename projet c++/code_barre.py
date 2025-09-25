import cv2
from pyzbar import pyzbar

PRODUCT_PRICES = {
    "5901234123457": 10.99,
    "6191442501294": 1.500,
    "051111407592": 7.59,
}

def get_product_price(barcode_data):
    return PRODUCT_PRICES.get(barcode_data, "Price not available")

def barcode_scanner():
    cap = cv2.VideoCapture(1)  # Use camera index 0 for the built-in camera

    while True:
        ret, frame = cap.read()

        if not ret:
            print("Failed to capture frame from the camera.")
            break

        frame = cv2.resize(frame, (800, 600))

        barcodes = pyzbar.decode(frame)

        for barcode in barcodes:
            barcode_data = barcode.data.decode("utf-8")
            barcode_type = barcode.type

            (x, y, w, h) = barcode.rect
            cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)

            product_price = get_product_price(barcode_data)

            text = "{} ({}): {}".format(barcode_data, barcode_type, product_price)
            cv2.putText(frame, text, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 255, 0), 2)

        cv2.imshow("Barcode Scanner", frame)

        key = cv2.waitKey(1) & 0xFF
        if key == ord("q"):
            break

    cap.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    barcode_scanner()

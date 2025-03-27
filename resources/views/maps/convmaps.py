import rasterio
from rasterio.plot import reshape_as_image
import numpy as np
from PIL import Image, ImageDraw

file_path = f"D:/Reza/Project/laragon/www/locatorgis/public/storage/uploads/Basemap_w2824 - Copy (1).ecw"


with rasterio.open(file_path) as src:
    img = reshape_as_image(src.read())
    transform = src.transform
    profile = src.profile

# Convert Easting/Northing to pixel coordinates
x, y = (1, 1)
row, col = ~transform * (x, y)  # Inverse transform

# Draw points using PIL
pil_img = Image.fromarray(img)
draw = ImageDraw.Draw(pil_img)
draw.ellipse((col-2, row-2, col+2, row+2), fill="red")  # Draw a red circle

# Save as GeoTIFF
img_modified = np.array(pil_img)
profile.update(driver="GTiff")
with rasterio.open("output-1.tif", "w", **profile) as dst:
    dst.write(img_modified.transpose(2, 0, 1))  # Reorder channels
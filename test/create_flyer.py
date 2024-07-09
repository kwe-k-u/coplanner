from PIL import Image, ImageDraw, ImageFont
import json

# Read the JSON file
with open('test.json') as f:
	data = json.load(f)

# Get the file paths from the JSON data
background_image_path = data['background_image']
foreground_image_path = data['foreground_image']

# Open the background and foreground images
background_image = Image.open(background_image_path)
foreground_image = Image.open(foreground_image_path)

# Rest of the code...

# Create a Draw object for the background image
modified_background = ImageDraw.Draw(background_image)

def writeText(cordinates, image, text, fontsize=24, bold=False, seed=None):
    font = getFont(fontsize, bold)
    if seed:
        cordinates = (cordinates[0] + image.textlength(seed[0], getFont(seed[1], seed[2])), cordinates[1])
    image.text(cordinates, text, fill="white", font=font)

def getFont(size, bold):
    return ImageFont.truetype("Poppins-Bold.ttf" if bold else "Poppins-Regular.ttf", int(size * 1.5))

def drawCurvedBox(image, start, end, color="#1204B5"):
    image.rounded_rectangle([start, end], 40, fill=color)

def applyMask(image, start, end):
    # Create a mask with the same size as the image
    mask = Image.new("L", image.size, 0)
    draw = ImageDraw.Draw(mask)

    # Calculate the rectangle size relative to the image size
    box_width, box_height = end[0] - start[0], end[1] - start[1]
    draw.rounded_rectangle([start, (start[0] + box_width, start[1] + box_height)], radius=40, fill=255)

    # Resize the foreground image to match the box size
    cropped_foreground = image
    cropped_foreground = cropped_foreground.resize((box_width, box_height), Image.LANCZOS)

    # Apply the mask to the resized foreground image
    cropped_foreground.putalpha(mask.crop((start[0], start[1], start[0] + box_width, start[1] + box_height)))

    return cropped_foreground

# Drawing operations
drawCurvedBox(modified_background, (108, 685), (972, 914))

# Apply mask to the foreground image
masked_foreground = applyMask(foreground_image, (601, 701), (928, 896))

# Paste the masked foreground image onto the background image
background_image.paste(masked_foreground, (601, 701), masked_foreground)

# Draw additional elements on the background image
drawCurvedBox(modified_background, (147, 785), (272, 785), "yellow")
text_tuples = [((293, 385),"Book A seat on",42,True),
               ((73, 455),"www.easygo.com.gh", 55,True),
               ((147, 725), data["experience_name"], 24, True),
               ((147, 800), data["date"], 17,False),
               ((147, 832), data["price"], 30,True),
               ((380, 850), "Per Person", 19,False)
               ]
for values in text_tuples:
	writeText(values[0], modified_background, values[1], values[2], bold=values[3])


# Show the final image
background_image.show()
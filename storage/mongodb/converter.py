# convert mongodb data to json
#  import needed modules
import json
import bson 
import os
 

# convert bson to json
def convert_bson_to_json(source_filename, target_filename): 
    with open(source_filename, 'rb') as f:
        # Read the file
        data = f.read()
        # Decode the file
        data = bson.decode_all(data)
        # Convert the file to json
        data = json.dumps(data)
        # Write the file
        with open(target_filename, 'w') as f:
            f.write(data)
        # Print the file
        print(data)
        # Close the file
        f.close()


for file in os.listdir("."):
    if file.endswith(".bson"):
        print(file)
        convert_bson_to_json(file, file.replace(".bson", ".json"))
import aspose.words as aw 
try: 
  
    # Open the Document 
    doc = aw.Document("C:\\Users\\Nana Aba Ackah\\Desktop\\BLOCKMAP.pdf")
  
# Save the Document in the TIFF Format 
    doc.save('C:\\Users\\Nana Aba Ackah\\Desktop\\BLOCKMAP.pdf') 
  
# Print it is Converted! 
    print("Successfully Converted!") 
  
except: 
  
    # Print Couldn't Convert 
    print("Couldn't Convert") 
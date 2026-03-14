import sys
import json
import pdfplumber

# Receive arguments from PHP
cv_file = sys.argv[1]
skills = sys.argv[2]
min_score = int(sys.argv[3])

required_skills = [s.strip().lower() for s in skills.split(",")]

# Extract CV text
text = ""
with pdfplumber.open(cv_file) as pdf:
    for page in pdf.pages:
        page_text = page.extract_text()
        if page_text:
            text += page_text.lower()

# Skill matching
matched = []
missing = []

for skill in required_skills:
    if skill in text:
        matched.append(skill)
    else:
        missing.append(skill)

# Score calculation
total = len(required_skills)

if total == 0:
    score = 0
else:
    score = int((len(matched) / total) * 100)

# Decision
status = "shortlisted" if score >= min_score else "rejected"

result = {
    "score": score,
    "status": status,
    "matched_skills": matched,
    "missing_skills": missing
}

print(json.dumps(result))





# import sys
# import json
# import pdfplumber
# from google import genai
# from google.genai import types

# # =========================
# # SINGLE API CONFIG
# # =========================
# API_KEY = ""
# MODEL = "gemini-2.0-flash-lite"  # default recommended model

# # =========================
# # GET DATA FROM PHP
# # =========================
# cv_file = sys.argv[1]              # path to uploaded CV PDF
# skills = sys.argv[2]               # required skills string from PHP
# min_score = int(sys.argv[3])       # minimum score threshold

# required_skills = [s.strip() for s in skills.split(",")]

# # =========================
# # EXTRACT TEXT FROM CV
# # =========================
# cv_text = ""
# with pdfplumber.open(cv_file) as pdf:
#     for page in pdf.pages:
#         text = page.extract_text()
#         if text:
#             cv_text += text

# # =========================
# # PREPARE PROMPT
# # =========================
# prompt = f"""
# You are an HR AI.

# Required Skills:
# {required_skills}

# Analyze this CV and return ONLY JSON.

# Format:
# {{
#  "score": number,
#  "status": "shortlisted" or "rejected",
#  "matched_skills": [],
#  "missing_skills": []
# }}

# Rules:
# Score from 0-100.
# If score >= {min_score} → shortlisted
# If score < {min_score} → rejected

# CV:
# {cv_text}
# """

# contents = [
#     types.Content(
#         role="user",
#         parts=[types.Part.from_text(text=prompt)],
#     )
# ]

# # =========================
# # CALL THE API
# # =========================
# response_text = ""
# try:
#     client = genai.Client(api_key=API_KEY)
#     for chunk in client.models.generate_content_stream(
#             model=MODEL,
#             contents=contents):
#         if chunk.text:
#             response_text += chunk.text

# except Exception as e:
#     # Return a safe JSON if API fails
#     data = {
#         "score": 0,
#         "status": "error",
#         "matched_skills": [],
#         "missing_skills": []
#     }
#     print(json.dumps(data))
#     sys.exit()

# # =========================
# # PARSE JSON RESPONSE
# # =========================
# try:
#     data = json.loads(response_text)
# except:
#     data = {
#         "score": 0,
#         "status": "error",
#         "matched_skills": [],
#         "missing_skills": []
#     }

# # =========================
# # OUTPUT JSON
# # =========================
# print(json.dumps(data))
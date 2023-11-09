#!/bin/bash

# call: ~/autotest.sh ./Service .php 2 ./tests/
input_dir=$(echo $1 | sed 's:/*$::')        # Arg1: Input directory
file_ext=${2:-.php}                         # Arg2: File extension filter (default: .php)
depth=${3:-1}                               # Arg3: Depth (default: 1)
output_dir=$(echo $4 | sed 's:/*$::')       # Arg4: Output directory (default: tests/)
model=${5:-gpt-4}                           # Arg5: LLM Model name or alias (default: gpt-4)

# Write output dir
mkdir -p "${output_dir:-tests}"

while IFS= read -r file; do
    alter_path="${output_dir:-tests}/$(dirname "$file")"
    alter_file="${file#./}"
    alter_path="${output_dir:-tests}/$(dirname "$alter_file")"
    alter_file="${output_dir:-tests}/${alter_file}"
    alter_file="${alter_file/.php/Test.php}"

    mkdir -p $alter_path && echo "Writing test for class $file into $alter_file"
    test_class=$(cat "$file" | llm -m $model --no-stream 'write php tests for this code, just the code please, no introduction but with <?php')
    echo "$test_class" > $alter_file
done < <(find "$input_dir" -type f -name "*$file_ext" -maxdepth $depth)
